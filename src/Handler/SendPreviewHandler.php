<?php

namespace Mia\Mail\Handler;

use Mia\Auth\Request\MiaAuthRequestHandler;
use Mia\Core\Diactoros\MiaJsonErrorResponse;
use Mia\Mail\Model\MIAEmailTemplate;

/**
 * Description of ListHandler
 *
 * @author matiascamiletti
 */
class SendPreviewHandler extends MiaAuthRequestHandler
{
    /**
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface 
    {
        // Obtenemos ID si fue enviado
        $itemId = $this->getParam($request, 'id', '');
        // Buscar si existe el item en la DB
        $item = MIAEmailTemplate::find($itemId);
        // verificar si existe
        if($item === null){
            return new MiaJsonErrorResponse(-2, 'The template not exist');
        }
        // Get variables
        $testEmail = $this->getParam($request, 'email', '');
        $testSubject = $this->getParam($request, 'subject', '');
        $testContent = $this->getParam($request, 'content', '');

        /* @var $sendgrid \Mia\Mail\Service\Sendgrid */
        $sendgrid = $request->getAttribute('Sendgrid');
        $sendgrid->sendWithoutTemplate($testEmail, $testSubject, $testContent);

        // Devolvemos respuesta
        return new \Mia\Core\Diactoros\MiaJsonResponse(true);
    }
}