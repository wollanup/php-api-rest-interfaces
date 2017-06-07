<?php
/**
 * Created by PhpStorm.
 * User: steve
 * Date: 24/11/16
 * Time: 17:12
 */

namespace Eukles\RouteMap;

use Eukles\Action\ActionInterface;
use Eukles\Service\Router\RouteInterface;
use Eukles\Service\Router\RouterInterface;
use Psr\Container\ContainerInterface;

interface RouteMapInterface extends \Iterator
{
    
    public function __construct(ContainerInterface $container);
    
    /**
     * Adds a route to this RouteMap
     *
     * @param $method
     * @param $pattern
     *
     * @return RouteInterface
     */
    public function add($method, $pattern);
    
    /**
     * self::add('DELETE', $pattern) shortcut
     *
     * @param $pattern
     *
     * @return RouteInterface
     */
    public function delete($pattern);
    
    /**
     * self::add('GET', $pattern) shortcut
     *
     * @param $pattern
     *
     * @return RouteInterface
     */
    public function get($pattern);
    
    /**
     * @return string|ActionInterface
     */
    public function getActionClass();
    
    /**
     * @return ContainerInterface
     */
    public function getContainer();
    
    /**
     * @return string
     */
    public function getPackage();
    
    /**
     * @return string
     */
    public function getPrefix();
    
    /**
     * @return string
     */
    public function getResource();
    
    /**
     * @return bool
     */
    public function hasPackage();
    
    /**
     * @return bool
     */
    public function isSubResourceOfPackage();
    
    /**
     * self::add('PATCH', $pattern) shortcut
     *
     * @param $pattern
     *
     * @return RouteInterface
     */
    public function patch($pattern);
    
    /**
     * self::add('POST', $pattern) shortcut
     *
     * @param $pattern
     *
     * @return RouteInterface
     */
    public function post($pattern);
    
    /**
     * self::add('PUT', $pattern) shortcut
     *
     * @param $pattern
     *
     * @return RouteInterface
     */
    public function put($pattern);
    
    /**
     * Map all Routes contained in this RouteMap to th given Router Object
     *
     * @param RouterInterface $router
     *
     * @return mixed
     */
    public function registerRoutes(RouterInterface $router);
}
