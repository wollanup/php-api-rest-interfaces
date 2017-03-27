<?php
/**
 * Created by PhpStorm.
 * User: steve
 * Date: 19/01/17
 * Time: 13:26
 */

namespace Eukles\Slim;

use Eukles\Service\ResourceRoute\ResourceRouteInterface;

interface RouterInterface extends \Slim\Interfaces\RouterInterface
{
    
    /**
     * @param ResourceRouteInterface $resourceRoute
     *
     * @return ResourceRouteInterface
     */
    public function addResourceRoute(ResourceRouteInterface $resourceRoute);
}
