<?php
/**
 * Created by PhpStorm.
 * User: steve
 * Date: 26/07/16
 * Time: 12:00
 */

namespace Eukles\Service;

use Eukles\Service\Container\EuklesContainerInterface;

interface ServiceInterface
{
    
    public function __construct(EuklesContainerInterface $container);
}
