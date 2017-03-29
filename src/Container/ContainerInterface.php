<?php
/**
 * Created by PhpStorm.
 * User: steve
 * Date: 26/07/16
 * Time: 11:18
 */

namespace Eukles\Container;

use Eukles\Entity\EntityFactoryInterface;
use Eukles\Service\QueryModifier\RequestQueryModifierInterface;
use Eukles\Service\ResponseBuilder\ResponseBuilderInterface;
use Eukles\Service\ResponseFormatter\ResponseFormatterInterface;
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
    const ENTITY_FACTORY = 'entityFactory';
    const HANDLER = 'foundHandler';
    const SESSION = 'session';
    const ROUTES_MAP = 'routeMap';
    const ENTITY_REQUEST = 'entityRequest';
    const ROUTER = 'router';
    const ROUTES_CLASSES = 'routesClasses';

    /**
     * @return EntityFactoryInterface
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
    
    /**
     * @return RoutesClassesInterface
     */
    public function getRoutesClasses();

}
