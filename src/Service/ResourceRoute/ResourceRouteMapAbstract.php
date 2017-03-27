<?php
/**
 * Created by PhpStorm.
 * User: steve
 * Date: 24/11/16
 * Time: 17:15
 */

namespace Eukles\Service\ResourceRoute;

use Eukles\Action\ActionInterface;
use Eukles\Propel\Runtime\ActiveRecord\ActiveRecordRequestInterface;
use Eukles\Service\Container\EuklesContainerInterface;
use Eukles\Slim\RouterInterface;
use Eukles\Util\DataIterator;

/**
 * Class ResourceRouteMapAbstract
 *
 * @property ResourceRouteInterface[] $data
 *
 * @package Eukles\Service\ResourceRoute
 */
abstract class ResourceRouteMapAbstract extends DataIterator implements ResourceRouteMapInterface
{

    /**
     * @var string|ActionInterface
     */
    protected $actionClass;
    /**
     * @var EuklesContainerInterface
     */
    protected $container;
    /**
     * @var string
     */
    protected $packageName;
    /**
     * @var string|ActiveRecordRequestInterface
     */
    protected $requestClass;
    /**
     * @var string
     */
    protected $resourceName;
    /**
     * @var string
     */
    protected $routesPrefix;

    /**
     * ResourceRouteMapAbstract constructor.
     *
     * @param EuklesContainerInterface $container
     */
    final public function __construct(EuklesContainerInterface $container)
    {
        $this->container = $container;
        $this->initialize();
    }

    /**
     * @inheritdoc
     */
    public function getActionClass()
    {
        return $this->actionClass;
    }

    /**
     * @return EuklesContainerInterface
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @return string
     */
    public function getPackage()
    {
        return ($this->isSubResourceOfPackage()) ? $this->packageName : $this->resourceName;
    }

    final public function registerRoutes(RouterInterface $router)
    {
        foreach ($this->data as $resourceRoute) {
            $resourceRoute->bindToRouter($router);
        }
    }

    /**
     * @param $method
     * @param $pattern
     *
     * @return ResourceRouteInterface
     */
    final protected function add($method, $pattern)
    {
        $route = new ResourceRoute($this, $method);
        $route->setContainer($this->container);
        $route->setActionClass($this->actionClass);
        $route->setRequestClass($this->requestClass);
        $route->setPackage($this->getPackage());
        $prefixes = [$this->resourceName];
        if ($this->isSubResourceOfPackage()) {
            # Add package before resource
            array_unshift($prefixes, $this->packageName);
        }
        if ($this->routesPrefix) {
            # Add prefix before resource
            array_unshift($prefixes, $this->routesPrefix);
        }
        $pattern = $this->trailingSlash('/' . implode('/', $prefixes) . $pattern);
        $route->setPattern($pattern);

        $this->data[] = $route;

        return $route;
    }

    /**
     * self::add('DELETE', $pattern) shortcut
     *
     * @param $pattern
     *
     * @return ResourceRouteInterface
     */
    final protected function delete($pattern)
    {
        return $this->add(ResourceRoute::DELETE, $pattern);
    }

    /**
     * self::add('GET', $pattern) shortcut
     *
     * @param $pattern
     *
     * @return ResourceRouteInterface
     */
    final protected function get($pattern)
    {
        return $this->add(ResourceRoute::GET, $pattern);
    }

    /**
     * Routes
     *
     * ```
     * $this->add('GET', '/{id:[0-9]+}')
     *     ->setRoles(['user',])
     *     ->setActionClass(OtherClass::class)
     *     ->setActionMethod('get');
     *```
     *
     * @return mixed
     */
    abstract protected function initialize();

    /**
     * self::add('PATCH', $pattern) shortcut
     *
     * @param $pattern
     *
     * @return ResourceRouteInterface
     */
    final protected function patch($pattern)
    {
        return $this->add(ResourceRoute::PATCH, $pattern);
    }

    /**
     * self::add('POST', $pattern) shortcut
     *
     * @param $pattern
     *
     * @return ResourceRouteInterface
     */
    final protected function post($pattern)
    {
        return $this->add(ResourceRoute::POST, $pattern);
    }

    /**
     * self::add('PUT', $pattern) shortcut
     *
     * @param $pattern
     *
     * @return ResourceRouteInterface
     */
    final protected function put($pattern)
    {
        return $this->add(ResourceRoute::PUT, $pattern);
    }

    private function hasPackage()
    {
        return null !== $this->packageName;
    }

    private function isSubResourceOfPackage()
    {
        if (!$this->hasPackage()) {
            return false;
        }

        return $this->resourceName !== $this->packageName;
    }

    private function trailingSlash($routeName)
    {
        if (substr($routeName, -1) === ']') {
            $routeName = rtrim($routeName, ']');
            $routeName .= '/]';

            return $routeName;
        }

        if (substr($routeName, -1) !== '/') {
            $routeName .= '/';
        }

        return $routeName;
    }
}
