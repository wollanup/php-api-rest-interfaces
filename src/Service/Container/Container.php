<?php
/**
 * Created by PhpStorm.
 * User: steve
 * Date: 18/05/16
 * Time: 14:45
 */

namespace Eukles\Service\Container;

use Eukles\Propel\Runtime\ActiveRecord\ActiveRecordRequestFactory;
use Eukles\Propel\Runtime\ActiveRecord\ActiveRecordRequestFactoryInterface;
use Eukles\Service\RequestQueryModifier\DefaultRequestQueryModifier;
use Eukles\Service\RequestQueryModifier\RequestQueryModifierInterface;
use Eukles\Service\ResponseBuilder\ResponseBuilderInterface;
use Eukles\Service\ResponseFormatter\ResponseFormatterInterface;
use Eukles\Service\RoutesClasses\ResourceRouteMapClassesInterface;
use Eukles\Service\RoutesClasses\ResourceRouteMapClassesServiceMissingException;
use Eukles\Slim\Handlers\Strategies\ActionStrategy;
use Eukles\Slim\RouterInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Container as SlimContainer;
use Slim\Http\Request;

/**
 * Class Container
 *
 * @property-read Request request
 *
 * @package Eukles\Service
 */
class Container extends SlimContainer implements EuklesContainerInterface
{

    /**
     * Container constructor.
     *
     * @param array $values
     *
     * @throws ResourceRouteMapClassesServiceMissingException
     */
    public function __construct(array $values = [])
    {
        parent::__construct($values);

        # Default Found Handler
        if (!isset($values[self::HANDLER])) {
            $this[self::HANDLER] = function (EuklesContainerInterface $ci) {
                return new ActionStrategy($ci);
            };
        }

        # Default Request Query Modifier (Do nothing),
        # Use your own implementation of RequestQueryModifierInterface
        if (!isset($values[self::ACTIVE_RECORD_REQUEST_FACTORY])) {
            $this[self::ACTIVE_RECORD_REQUEST_FACTORY] = function (EuklesContainerInterface $ci) {
                return new ActiveRecordRequestFactory($ci);
            };
        }

        # Default Request Query Modifier (Do nothing),
        # Use your own implementation of RequestQueryModifierInterface
        if (!isset($values[self::REQUEST_QUERY_MODIFIER])) {
            $this[self::REQUEST_QUERY_MODIFIER] = function (EuklesContainerInterface $ci) {
                return new DefaultRequestQueryModifier($ci);
            };
        }

        # Default Response Builder (Do nothing),
        # Use your own implementation of RequestQueryModifierInterface
        if (!isset($values[self::RESPONSE_BUILDER])) {
            $this[self::RESPONSE_BUILDER] = function () {
                return function ($result) {
                    return $result;
                };
            };
        }

        # Default Response Formatter (Do nothing),
        # Use your own implementation of RequestQueryModifierInterface
        if (!isset($values[self::RESPONSE_FORMATTER])) {
            $this[self::RESPONSE_FORMATTER] = function () {
                return function (ResponseInterface $response, $result) {
                    if ($response->getBody()->isWritable()) {
                        $response->getBody()
                            ->write(is_array($result) ? json_encode($result) : $result);
                    }

                    return $response;
                };
            };
        }
    }

    /**
     * @return ActiveRecordRequestFactoryInterface
     */
    public function getActiveRecordRequestFactory()
    {
        return $this[self::ACTIVE_RECORD_REQUEST_FACTORY];
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this['request'];
    }

    /**
     * @return RequestQueryModifierInterface
     */
    public function getRequestQueryModifier()
    {
        return $this[self::REQUEST_QUERY_MODIFIER];
    }

    /**
     * @return ResourceRouteMapClassesInterface
     */
    public function getResourceRouteMapClasses()
    {
        return $this[self::RESOURCE_ROUTE_MAP_CLASSES];
    }

    /**
     * @return ResponseBuilderInterface
     */
    public function getResponseBuilder()
    {
        return $this[self::RESPONSE_BUILDER];
    }

    /**
     * @return ResponseFormatterInterface
     */
    public function getResponseFormatter()
    {
        return $this[self::RESPONSE_FORMATTER];
    }

    /**
     * @return RouterInterface
     */
    public function getRouter()
    {
        return $this[self::ROUTER];
    }
}
