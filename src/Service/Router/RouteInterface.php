<?php
/**
 * Created by PhpStorm.
 * User: steve
 * Date: 25/11/16
 * Time: 11:40
 */

namespace Eukles\Service\Router;

use Eukles\Entity\EntityRequestInterface;
use Eukles\Service\Router\Exception\RouteEmptyValueException;
use Psr\Container\ContainerInterface;
use Zend\Permissions\Acl\Role\RoleInterface;

interface RouteInterface extends \Slim\Interfaces\RouteInterface
{
    
    const POST = "POST";
    const GET = "GET";
    const PATCH = "PATCH";
    const PUT = "PUT";
    const DELETE = "DELETE";
    
    /**
     * @param string|RoleInterface $role
     *
     * @return RouteInterface
     */
    public function addRole($role);
    
    /**
     * @param RouterInterface $router
     *
     * @return mixed
     */
    public function bindToRouter(RouterInterface $router);
    
    /**
     * Mark route as deprecated (won't be documented)
     *
     * @return RouteInterface
     */
    public function deprecated();
    
    /**
     * @return string
     * @throws RouteEmptyValueException
     */
    public function getActionClass();
    
    /**
     * @return string
     * @throws RouteEmptyValueException
     */
    public function getActionMethod();
    
    /**
     * Return callable or string like "MyClass:myMethod"
     *
     * @return callable|string
     */
    public function getCallable();
    
    /**
     * @return string
     */
    public function getIdentifier();
    
    /**
     * @return string|null
     */
    public function getNameOfInjectedParam();
    
    /**
     * @return string
     */
    public function getPackage();
    
    /**
     *
     * @return string|EntityRequestInterface
     */
    public function getRequestClass();
    
    /**
     * @return string
     * @throws RouteEmptyValueException
     */
    public function getResource();
    
    /**
     * @return array
     */
    public function getRoles();
    
    /**
     * @return string
     * @throws RouteEmptyValueException
     */
    public function getVerb();
    
    /**
     * @return bool
     */
    public function hasRoles();
    
    /**
     * Tells if route must use request or not to alter instance
     *
     * @return mixed
     */
    public function hasToUseRequest();
    
    /**
     * @return bool
     */
    public function isDeprecated();
    
    /**
     * @return bool
     */
    public function isMakeCollection();
    
    /**
     * @return bool
     */
    public function isMakeInstance();
    
    /**
     * @return bool
     */
    public function isMakeInstanceCreate();
    
    /**
     * @return bool
     */
    public function isMakeInstanceFetch();
    
    /**
     * @param bool $forceFetch
     *
     * @return RouteInterface
     */
    public function makeCollection($forceFetch = false);
    
    /**
     * @param bool $forceFetch
     *
     * @return RouteInterface
     */
    public function makeInstance($forceFetch = false);
    
    /**
     * @param string $actionClass
     *
     * @return RouteInterface
     */
    public function setActionClass($actionClass);
    
    /**
     * @param string $actionMethod
     *
     * @return RouteInterface
     */
    public function setActionMethod($actionMethod);
    
    /**
     * @param ContainerInterface $container
     *
     * @return mixed
     */
    public function setContainer(ContainerInterface $container);
    
    /**
     * @param string $identifier
     *
     * @return RouteInterface
     */
    public function setIdentifier($identifier);
    
    /**
     * @param string $nameOfInjectedParam
     *
     * @return RouteInterface
     */
    public function setNameOfInjectedParam($nameOfInjectedParam);
    
    /**
     * @param string $package
     *
     * @return RouteInterface
     */
    public function setPackage($package);
    
    /**
     * @param string $pattern
     *
     * @return RouteInterface
     */
    public function setPattern($pattern);
    
    /**
     * @param string $requestClass
     *
     * @return RouteInterface
     */
    public function setRequestClass($requestClass);
    
    /**
     * @param array $roles
     *
     * @return RouteInterface
     */
    public function setRoles(array $roles);
    
    /**
     * @param string $verb
     *
     * @return RouteInterface
     */
    public function setVerb($verb);
    
    /**
     * When route makes an instance, it can use request parameters to alter instance.
     *
     * Enabled by default.
     *
     * @param $bool
     *
     * @return RouteInterface
     */
    public function useRequest($bool);
}
