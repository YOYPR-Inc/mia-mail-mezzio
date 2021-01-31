<?php

namespace Mia\Mail\Handler;

use Mia\Auth\Request\MiaAuthRequestHandler;
use Mia\Mail\Model\MIAEmailTemplate;

/**
 * Description of ListHandler
 *
 * @author matiascamiletti
 */
class FetchTemplatesHandler extends MiaAuthRequestHandler
{
    /**
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface
    {
        // Obtener todos los templates
        $rows = MIAEmailTemplate::all();
        // Devolvemos respuesta
        return new \Mia\Core\Diactoros\MiaJsonResponse($rows->toArray());
    }
}