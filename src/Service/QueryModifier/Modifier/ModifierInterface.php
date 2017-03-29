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

namespace Eukles\Service\QueryModifier\Modifier;

use Propel\Runtime\ActiveQuery\ModelCriteria;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class ModifierBase
 *
 * @package Ged\Service\RequestQueryModifier
 */
interface ModifierInterface
{


    /**
     * ModifierBase constructor.
     *
     * @param ServerRequestInterface $request
     */
    public function __construct(ServerRequestInterface $request);

    /**
     * Apply the filter to the ModelQuery
     *
     * @param \Propel\Runtime\ActiveQuery\ModelCriteria $query
     */
    public function apply(ModelCriteria $query);

    /**
     * @param $property
     *
     * @return array
     */
    public function getModifier($property);

    /**
     * @return array
     */
    public function getModifiers();

    /**
     * Return the name of the modifier
     *
     * @return string
     */
    public function getName();

    /**
     * @param $property
     *
     * @return bool
     */
    public function hasModifier($property);
    /**
     * @param $property
     *
     * @return $this
     */
    public function removeModifier($property);

    /**
     * @param ServerRequestInterface $request
     *
     * @return $this
     */
    public function setModifierFromRequest(ServerRequestInterface $request);

    /**
     * @param ModelCriteria $query
     * @param               $clause
     * @param array         $modifier
     *
     * @return mixed
     */
    public function applyModifier(ModelCriteria $query, $clause, array $modifier);

    
    /**
     * Has the modifier all required data to be applied?
     *
     * @param array $modifier
     *
     * @return bool
     */
    public function hasAllRequiredData(array $modifier);
}
