<?php
/**
 * Created by PhpStorm.
 * User: steve
 * Date: 25/01/17
 * Time: 10:56
 */

namespace Eukles\Service\Router;

use Eukles\Service\Route\RouteInterface;
use Eukles\Service\RouteMap\RouteMapInterface;
use Eukles\Service\RoutesClasses\RoutesClassesInterface;
use FastRoute\RouteParser;
use Psr\Container\ContainerInterface;

/**
 * Class Router
 *
 * @package Ged\Service
 */
class Router extends \Slim\Router implements RouterInterface
{

    /**
     * @var RouteMapInterface[]
     */
    private $routesMap = [];

    /**
     * Router constructor.
     *
     * @param RouteParser            $parser
     * @param ContainerInterface     $c
     * @param RoutesClassesInterface $routesClasses
     * @param string                 $routerCacheFile
     */
    public function __construct(
        RouteParser $parser = null,
        ContainerInterface $c,
        RoutesClassesInterface $routesClasses,
        $routerCacheFile
    )
    {
        parent::__construct($parser);
        $this->setCacheFile($routerCacheFile);
        foreach ($routesClasses as $className) {
            /** @var RouteMapInterface $routeMap */
            $routeMap = new $className($c);
            $routeMap->registerRoutes($this);
            $this->routesMap[] = $routeMap;
        }
    }

    /**
     * @param RouteInterface $resourceRoute
     *
     * @return RouteInterface
     */
    public function addResourceRoute(RouteInterface $resourceRoute)
    {
        $resourceRoute->setIdentifier('route' . $this->routeCounter++);
        // Add route
        $this->routes[$resourceRoute->getIdentifier()] = $resourceRoute;

        return $resourceRoute;
    }

    /**
     * @return RouteMapInterface[]
     */
    public function getRoutesMap()
    {
        return $this->routesMap;
    }
}
