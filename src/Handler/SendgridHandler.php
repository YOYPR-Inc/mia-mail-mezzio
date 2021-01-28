<?php

namespace Mia\Mail\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Mia\Core\Diactoros\MiaJsonErrorResponse;

/**
 * Description of SendgridHandler
 *
 * @author matiascamiletti
 */
class SendgridHandler extends \Mia\Core\Middleware\MiaBaseMiddleware
{
    /**
     * @var \Mobileia\Expressive\Mail\Service\Sendgrid
     */
    private $service;

    public function __construct(\Mia\Mail\Service\Sendgrid $sendgrid) {
        $this->service = $sendgrid;
    }
    
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        // Enviar servicio como atributo
        return $handler->handle($request->withAttribute('Sendgrid', $this->service));
    }
}