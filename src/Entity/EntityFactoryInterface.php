<?php
namespace Eukles\Entity;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Interface EntityFactoryInterface
 *
 * @package Core\Model
 */
interface EntityFactoryInterface
{

    /**
     * Create a new instance of activeRecord and add it to Request attributes
     *
     * @param EntityRequestInterface       $activeRecordRequest
     * @param ServerRequestInterface       $request
     * @param ResponseInterface            $response
     * @param callable                     $next
     * @param                              $nameOfParameterToAdd
     *
     * @return ResponseInterface
     */
    public function create(
        EntityRequestInterface $activeRecordRequest,
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next,
        $nameOfParameterToAdd = null
    );

    /**
     * Fetch an existing instance of activeRecord and add it to Request attributes
     *
     * @param EntityRequestInterface       $activeRecordRequest
     * @param ServerRequestInterface       $request
     * @param ResponseInterface            $response
     * @param callable                     $next
     * @param                              $nameOfParameterToAdd
     *
     * @return ResponseInterface
     */
    public function fetch(
        EntityRequestInterface $activeRecordRequest,
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next,
        $nameOfParameterToAdd = null
    );
}
