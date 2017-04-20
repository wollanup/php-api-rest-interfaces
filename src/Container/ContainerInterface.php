<?php
/**
 * Created by PhpStorm.
 * User: steve
 * Date: 26/07/16
 * Time: 11:18
 */

namespace Eukles\Container;

use Eukles\Entity\EntityFactoryInterface;
use Eukles\Service\Pagination\RequestPaginationInterface;
use Eukles\Service\QueryModifier\RequestQueryModifierInterface;
use Eukles\Service\ResponseBuilder\ResponseBuilderInterface;
use Eukles\Service\ResponseFormatter\ResponseFormatterInterface;
use Eukles\Service\RoutesClasses\RoutesClassesInterface;
use Eukles\Slim\Handlers\ActionErrorInterface;
use Eukles\Slim\Handlers\EntityRequestErrorInterface;
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
    const REQUEST_PAGINATION = 'requestPagination';
    const ENTITY_FACTORY = 'entityFactory';
    const HANDLER = 'foundHandler';
    const SESSION = 'session';
    const ROUTES_MAP = 'routeMap';
    const ENTITY_REQUEST = 'entityRequest';
    const ROUTER = 'router';
    const ROUTES_CLASSES = 'routesClasses';
    const ENTITY_REQUEST_ERROR_HANDLER = 'entityRequestErrorHandler';
    const ACTION_ERROR_HANDLER = 'actionErrorHandler';
    
    /**
     * @return ActionErrorInterface
     */
    public function getActionErrorHandler();
    
    /**
     * @return EntityFactoryInterface
     */
    public function getEntityFactory();

    /**
     * @return EntityRequestErrorInterface
     */
    public function getEntityRequestErrorHandler();
    
    /**
     * @return Request
     */
    public function getRequest();
    
    /**
     * @return RequestPaginationInterface
     */
    public function getRequestPagination();

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
