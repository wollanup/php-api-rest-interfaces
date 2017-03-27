<?php
/**
 * Created by PhpStorm.
 * User: steve
 * Date: 25/01/17
 * Time: 10:56
 */

namespace Eukles\Slim;

use Eukles\Service\Container\EuklesContainerInterface;
use Eukles\Service\ResourceRoute\ResourceRouteInterface;
use Eukles\Service\ResourceRoute\ResourceRouteMapAbstract;
use Eukles\Service\ResourceRoute\ResourceRouteMapInterface;
use FastRoute\RouteParser;

/**
 * Class Router
 *
 * @package Ged\Service
 */
class Router extends \Slim\Router implements RouterInterface
{
    
    /**
     * @var ResourceRouteMapInterface[]
     */
    private $routesMap = [];
    
    /**
     * Router constructor.
     *
     * @param RouteParser              $parser
     * @param EuklesContainerInterface $container
     * @param string                   $routerCacheFile
     */
    public function __construct(RouteParser $parser = null, EuklesContainerInterface $container, $routerCacheFile)
    {
        parent::__construct($parser);
        $this->container = $container;
        $this->setCacheFile($routerCacheFile);
        foreach ($this->container->getResourceRouteMapClasses() as $className) {
            /** @var ResourceRouteMapAbstract $routeMap */
            $routeMap = new $className($this->container);
            $routeMap->registerRoutes($this);
            $this->routesMap[] = $routeMap;
        }
    }
    
    /**
     * @param ResourceRouteInterface $resourceRoute
     *
     * @return ResourceRouteInterface
     */
    public function addResourceRoute(ResourceRouteInterface $resourceRoute)
    {
        $resourceRoute->setIdentifier('route' . $this->routeCounter++);
        // Add route
        $this->routes[$resourceRoute->getIdentifier()] = $resourceRoute;
        
        return $resourceRoute;
    }
    
    /**
     * @return ResourceRouteMapInterface[]
     */
    public function getRoutesMap()
    {
        return $this->routesMap;
    }
}
