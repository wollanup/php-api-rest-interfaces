<?php
/**
 * Created by PhpStorm.
 * User: steve
 * Date: 24/11/16
 * Time: 17:12
 */

namespace Eukles\Service\RouteMap;

use Eukles\Service\Router\RouterInterface;
use Psr\Container\ContainerInterface;

interface RouteMapInterface extends \Iterator
{

    public function __construct(ContainerInterface $container);

    /**
     * @return ContainerInterface
     */
    public function getContainer();

    /**
     * @return string
     */
    public function getPackage();

    /**
     * Map all Routes contained in this RouteMap to th given Router Object
     *
     * @param RouterInterface $router
     *
     * @return mixed
     */
    public function registerRoutes(RouterInterface $router);
}
