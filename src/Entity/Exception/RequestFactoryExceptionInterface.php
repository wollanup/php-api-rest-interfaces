<?php
/**
 * File description
 *
 * @package
 * @version      $LastChangedRevision:$
 *               $LastChangedDate:$
 * @link         $HeadURL:$
 * @author       $LastChangedBy:$
 */

namespace Eukles\Service\QueryModifier\Modifier\Exception;

use Eukles\Entity\EntityRequestInterface;
use Eukles\Exception\ApiProblemExceptionInterface;

/**
 * Class ModifierException
 *
 * @package Ged\Service\RequestQueryModifier\Exceptions
 */
interface RequestFactoryExceptionInterface extends ApiProblemExceptionInterface
{
    
    /**
     * RequestFactoryExceptionInterface constructor.
     *
     * @param EntityRequestInterface $entityRequest
     * @param \Exception             $previous
     */
    public function __construct(EntityRequestInterface $entityRequest, \Exception $previous = null);
}
