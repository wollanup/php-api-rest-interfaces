<?php
/**
 * Created by PhpStorm.
 * User: steve
 * Date: 29/05/17
 * Time: 15:46
 */

namespace Eukles\Service\XssCleaner;

interface XssCleanerInterface
{
    
    /**
     * @param array $array
     *
     * @return []
     */
    public function cleanArray(array $array);
    
    /**
     * @param string $string
     *
     * @return string
     */
    public function cleanString($string);
}
