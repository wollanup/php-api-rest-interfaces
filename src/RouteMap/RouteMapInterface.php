<?php
/**
 * Created by PhpStorm.
 * User: steve
 * Date: 24/11/16
 * Time: 17:12
 */

namespace Eukles\RouteMap;

use Eukles\Action\ActionInterface;
use Eukles\Service\Router\RouterInterface;
use Psr\Container\ContainerInterface;

interface RouteMapInterface extends \Iterator
{
    
    public function __construct(ContainerInterface $container);
    
    
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
     * Map all Routes contained in this RouteMap to th given Router Object
     *
     * @param RouterInterface $router
     *
     * @return mixed
     */
    public function registerRoutes(RouterInterface $router);
}
