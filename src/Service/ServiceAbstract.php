<?php
/**
 * Created by PhpStorm.
 * User: steve
 * Date: 26/07/16
 * Time: 12:01
 */

namespace Eukles\Service;

use Eukles\Service\Container\EuklesContainerInterface;

abstract class ServiceAbstract implements ServiceInterface
{
    
    /**
     * @var EuklesContainerInterface
     */
    protected $container;
    
    public function __construct(EuklesContainerInterface $container)
    {
        $this->container = $container;
    }
}
