<?php
/**
 * Created by PhpStorm.
 * User: steve
 * Date: 25/11/16
 * Time: 11:40
 */

namespace Eukles\Service\ResourceRoute;

use Eukles\Propel\Runtime\ActiveRecord\ActiveRecordRequestInterface;
use Eukles\Service\ResourceRoute\Exception\ResourceRouteEmptyValueException;
use Eukles\Slim\RouterInterface;
use Psr\Container\ContainerInterface;
use Slim\Interfaces\RouteInterface;
use Zend\Permissions\Acl\Role\RoleInterface;

interface ResourceRouteInterface extends RouteInterface
{

    const POST = "POST";
    const GET = "GET";
    const PATCH = "PATCH";
    const PUT = "PUT";
    const DELETE = "DELETE";

    /**
     * @param string|RoleInterface $role
     *
     * @return ResourceRouteInterface
     */
    public function addRole($role);

    /**
     * @param RouterInterface $router
     *
     * @return mixed
     */
    public function bindToRouter(RouterInterface $router);

    /**
     * @return string
     * @throws ResourceRouteEmptyValueException
     */
    public function getActionClass();

    /**
     * @return string
     * @throws ResourceRouteEmptyValueException
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
     * @return string|ActiveRecordRequestInterface
     * @throws ResourceRouteEmptyValueException
     */
    public function getRequestClass();

    /**
     * @return string
     * @throws ResourceRouteEmptyValueException
     */
    public function getResource();

    /**
     * @return array
     */
    public function getRoles();

    /**
     * @return string
     * @throws ResourceRouteEmptyValueException
     */
    public function getVerb();

    /**
     * @return bool
     */
    public function hasRoles();

    /**
     * @return bool
     */
    public function isMakeInstance();

    /**
     * @param bool $forceFetch
     *
     * @return ResourceRouteInterface
     */
    public function makeInstance($forceFetch = false);

    /**
     * @param string $actionClass
     *
     * @return ResourceRouteInterface
     */
    public function setActionClass($actionClass);

    /**
     * @param string $actionMethod
     *
     * @return ResourceRouteInterface
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
     * @return ResourceRouteInterface
     */
    public function setIdentifier($identifier);

    /**
     * @param string $nameOfInjectedParam
     *
     * @return ResourceRouteInterface
     */
    public function setNameOfInjectedParam($nameOfInjectedParam);

    /**
     * @return string
     */
    public function getPackage();
    
    /**
     * @param string $package
     *
     * @return RouteInterface
     */
    public function setPackage($package);

    /**
     * @param string $pattern
     *
     * @return ResourceRouteInterface
     */
    public function setPattern($pattern);

    /**
     * @param string $requestClass
     *
     * @return ResourceRouteInterface
     */
    public function setRequestClass($requestClass);

    /**
     * @param array $roles
     *
     * @return ResourceRouteInterface
     */
    public function setRoles(array $roles);

    /**
     * @param string $verb
     *
     * @return ResourceRouteInterface
     */
    public function setVerb($verb);
}
