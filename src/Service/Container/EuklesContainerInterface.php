<?php
/**
 * Created by PhpStorm.
 * User: steve
 * Date: 26/07/16
 * Time: 11:18
 */

namespace Eukles\Service\Container;

use Eukles\Propel\Runtime\ActiveRecord\ActiveRecordRequestFactoryInterface;
use Eukles\Service\RequestQueryModifier\RequestQueryModifierInterface;
use Eukles\Service\ResponseBuilder\ResponseBuilderInterface;
use Eukles\Service\ResponseFormatter\ResponseFormatterInterface;
use Eukles\Service\RoutesClasses\ResourceRouteMapClassesInterface;
use Eukles\Slim\RouterInterface;
use Psr\Container\ContainerInterface;
use Slim\Http\Request;

/**
 * Interface EuklesContainer
 */
interface EuklesContainerInterface extends ContainerInterface
{

    const RESPONSE_FORMATTER = 'responseFormatter';
    const RESPONSE_BUILDER = 'responseBuilder';
    const REQUEST_QUERY_MODIFIER = 'requestQueryModifier';
    const ACTIVE_RECORD_REQUEST_FACTORY = 'activeRecordRequestFactory';
    const HANDLER = 'foundHandler';
    const SESSION = 'session';
    const RESOURCE_ROUTES_MAP = 'resourceRouteMap';
    const ACTIVE_RECORD_REQUEST = 'activeRecordRequest';
    const ROUTER = 'router';
    const RESOURCE_ROUTE_MAP_CLASSES = 'resourceRouteMapClasses';

    /**
     * @return ActiveRecordRequestFactoryInterface
     */
    public function getActiveRecordRequestFactory();

    /**
     * @return Request
     */
    public function getRequest();

    /**
     * @return RequestQueryModifierInterface
     */
    public function getRequestQueryModifier();

    /**
     * @return ResourceRouteMapClassesInterface
     */
    public function getResourceRouteMapClasses();

    /**
     * @return ResponseBuilderInterface
     */
    public function getResponseBuilder();

    /**
     * @return ResponseFormatterInterface
     */
    public function getResponseFormatter();

    /**
     * @return RouterInterface
     */
    public function getRouter();

}
