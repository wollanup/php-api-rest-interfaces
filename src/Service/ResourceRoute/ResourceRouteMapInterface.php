<?php
/**
 * Created by PhpStorm.
 * User: steve
 * Date: 24/11/16
 * Time: 17:12
 */

namespace Eukles\Service\ResourceRoute;

use Eukles\Action\ActionInterface;
use Eukles\Service\Container\EuklesContainerInterface;
use Eukles\Slim\RouterInterface;

interface ResourceRouteMapInterface extends \Iterator
{
    
    public function __construct(EuklesContainerInterface $container);

    /**
     * @return string|ActionInterface
     */
    public function getActionClass();
    
    /**
     * @return EuklesContainerInterface
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
