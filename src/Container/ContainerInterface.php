<?php
/**
 * Created by PhpStorm.
 * User: steve
 * Date: 26/07/16
 * Time: 11:18
 */

namespace Eukles\Container;

use Eukles\Service\RoutesClasses\RoutesClassesInterface;
use Slim\Http\Request;
use Slim\Interfaces\RouterInterface;

/**
 * Interface Container
 */
interface ContainerInterface extends \Psr\Container\ContainerInterface
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
    const ROUTES_CLASSES = 'routesClasses';

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
     * @return RoutesClassesInterface
     */
    public function getRoutesClasses();

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
