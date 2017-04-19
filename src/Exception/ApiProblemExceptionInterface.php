<?php
/**
 * Created by PhpStorm.
 * User: steve
 * Date: 19/04/17
 * Time: 17:16
 */

namespace Eukles\Exception;

use Symfony\Component\Translation\Translator;

/**
 * Interface ApiExceptionInterface
 *
 * @package Ged\Exception
 */
interface ApiProblemExceptionInterface
{
    
    /**
     * @param Translator $translator
     *
     * @return string
     */
    public function getDetail(Translator $translator);
    
    /**
     * @return string
     */
    public function getInstance();
    
    /**
     * @param Translator $translator
     *
     * @return string
     */
    public function getTitle(Translator $translator);
    
    /**
     * @return string
     */
    public function getType();
}
