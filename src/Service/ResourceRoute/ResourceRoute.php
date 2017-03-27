<?php
/**
 * Created by PhpStorm.
 * User: steve
 * Date: 25/11/16
 * Time: 11:40
 */

namespace Eukles\Service\ResourceRoute;

use Eukles\Service\Container\EuklesContainerInterface;
use Eukles\Service\ResourceRoute\Exception\ResourceRouteEmptyValueException;
use Eukles\Slim\RouterInterface;
use Slim\Route;
use Zend\Permissions\Acl\Role\GenericRole;
use Zend\Permissions\Acl\Role\RoleInterface;

class ResourceRoute extends Route implements ResourceRouteInterface
{
    
    /**
     * @var bool
     */
    protected $instanceForceFetch = false;
    /**
     * @var string
     */
    private $actionClass;
    /**
     * @var string
     */
    private $actionMethod;
    /**
     * @var bool
     */
    private $instanceFromPk = false;
    /**
     * @var string
     */
    private $nameOfInjectedParam;
    /**
     * @var string
     */
    private $package;
    /**
     * @var string
     */
    private $requestClass;
    /**
     * @var string
     */
    private $resource;
    /**
     * @var array
     */
    private $roles;
    /**
     * @var string
     */
    private $verb;

    public function __construct(ResourceRouteMapInterface $resourceRouteMap, $method)
    {
        parent::__construct($method, null, null, [], 0);
        $this->container = $resourceRouteMap->getContainer();
        // According to RFC methods are defined in uppercase (See RFC 7231)
        $this->methods = array_map("strtoupper", $this->methods);
    }

    /**
     * @param string|RoleInterface $role
     *
     * @return ResourceRouteInterface
     */
    public function addRole($role)
    {
        if (is_string($role)) {
            $this->roles[] = new GenericRole($role);
        } elseif (!$role instanceof RoleInterface) {
            throw new \InvalidArgumentException(
                'addRole() expects $role to be of type Zend\Permissions\Acl\Role\RoleInterface'
            );
        }

        return $this;
    }

    public function bindToRouter(RouterInterface $router)
    {
        $this->callable = sprintf('%s:%s', $this->getActionClass(), $this->getActionMethod());
        /** @var ResourceRouteInterface $route */

        if ($this->isMakeInstance()) {
            $resourceRoute = $this;
            if ($this->getVerb() === ResourceRoute::POST && !$this->instanceForceFetch) {
                # POST : create
                $this->add(function ($request, $response, $next) use ($resourceRoute) {
                    $requestClass = $resourceRoute->getRequestClass();
                    /** @var EuklesContainerInterface $this */
                    $response = $this->getActiveRecordRequestFactory()->create(
                        new $requestClass($this),
                        $request,
                        $response,
                        $next,
                        $resourceRoute->getNameOfInjectedParam()
                    );
    
                    return $response;
                });
            } else {
                # OTHERS : fetch
                $this->add(function ($request, $response, $next) use ($resourceRoute) {
                    $requestClass = $resourceRoute->getRequestClass();
                    /** @var EuklesContainerInterface $this */
                    $response = $this->getActiveRecordRequestFactory()->fetch(
                        new $requestClass($this),
                        $request,
                        $response,
                        $next,
                        $resourceRoute->getNameOfInjectedParam()
                    );
    
                    return $response;
                });
            }
        }
    
        $router->addResourceRoute($this);
    }
    
    /**
     * @return string
     */
    public function getActionClass()
    {
        return $this->required($this->actionClass);
    }

    /**
     * @param string $actionClass
     *
     * @return ResourceRouteInterface
     */
    public function setActionClass($actionClass)
    {
        $this->actionClass = $actionClass;

        return $this;
    }

    /**
     * @return string
     */
    public function getActionMethod()
    {
        return $this->required($this->actionMethod);
    }

    /**
     * @param string $actionMethod
     *
     * @return ResourceRouteInterface
     */
    public function setActionMethod($actionMethod)
    {
        $this->actionMethod = $actionMethod;

        return $this;
    }

    public function getName()
    {
        return sprintf('%s:%s', $this->getResource(), $this->getActionMethod());
    }

    /**
     * @return string
     */
    public function getNameOfInjectedParam()
    {
        return $this->nameOfInjectedParam;
    }

    /**
     * @param string $nameOfInjectedParam
     *
     * @return ResourceRouteInterface
     */
    public function setNameOfInjectedParam($nameOfInjectedParam)
    {
        $this->nameOfInjectedParam = $nameOfInjectedParam;

        return $this;
    }
    
    public function getPackage()
    {
        return $this->package;
    }
    
    /**
     * @param string $package
     *
     * @return ResourceRouteInterface
     */
    public function setPackage($package)
    {
        $this->package = $package;

        return $this;
    }
    
    /**
     * @return string
     */
    public function getPattern()
    {
        return $this->required($this->pattern);
    }
    
    /**
     * @return string
     */
    public function getRequestClass()
    {
        return $this->required($this->requestClass);
    }
    
    /**
     * @param string $requestClass
     *
     * @return ResourceRouteInterface
     */
    public function setRequestClass($requestClass)
    {
        $this->requestClass = $requestClass;
    
        return $this;
    }
    
    /**
     * @return string
     * @throws ResourceRouteEmptyValueException
     */
    public function getResource()
    {
        return $this->required($this->resource);
    }
    
    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }
    
    /**
     * @param array $roles
     *
     * @return ResourceRouteInterface
     */
    public function setRoles(array $roles)
    {
        foreach ($roles as $role) {
            $this->addRole($role);
        }

        return $this;
    }
    
    /**
     * @return string
     */
    public function getVerb()
    {
        return $this->required($this->getMethods()[0]);
    }
    
    /**
     * @param string $verb UPPERCASE http method
     *
     * @return ResourceRouteInterface
     */
    public function setVerb($verb)
    {
        // According to RFC methods are defined in uppercase (See RFC 7231)
        $this->verb = strtoupper($verb);

        return $this;
    }
    
    /**
     * @return bool
     */
    public function hasRoles()
    {
        return false === empty($this->roles);
    }
    
    /**
     * @return ResourceRouteInterface
     */
    public function instanceFetch()
    {
        $this->instanceFromPk = true;
        
        return $this;
    }
    
    /**
     * @return boolean
     */
    public function isMakeInstance()
    {
        return $this->instanceFromPk;
    }
    
    /**
     * @param bool $forceFetch
     *
     * @return ResourceRouteInterface
     */
    public function makeInstance($forceFetch = false)
    {
        $this->instanceFromPk     = true;
        $this->instanceForceFetch = $forceFetch;

        return $this;
    }
    
    /**
     * @param string $identifier
     *
     * @return ResourceRouteInterface
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
    
        return $this;
    }
    
    /**
     * @param mixed $value
     *
     * @return mixed
     * @throws ResourceRouteEmptyValueException
     */
    private function required($value)
    {
        if (empty($value)) {
            throw new ResourceRouteEmptyValueException('Missing value');
        }
    
        return $value;
    }
}
