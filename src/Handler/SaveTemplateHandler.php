<?php

namespace Mia\Mail\Handler;

use Mia\Auth\Request\MiaAuthRequestHandler;
use Mia\Mail\Model\MIAEmailTemplate;

/**
 * Description of ListHandler
 *
 * @author matiascamiletti
 */
class SaveTemplateHandler extends MiaAuthRequestHandler
{
    /**
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface 
    {
        // Obtener item a procesar
        $item = $this->getForEdit($request);
        // Guardamos data
        $item->title = $this->getParam($request, 'title', '');
        $item->content = $this->getParam($request, 'content', '');
        $item->content_text = $this->getParam($request, 'content_text', '');
        $item->vars = $this->getParam($request, 'vars', []);
        $item->data = $this->getParam($request, 'data', []);
        $item->subject = $this->getParam($request, 'subject', '');
        
        try {
            $item->save();
        } catch (\Exception $exc) {
            return new \Mia\Core\Diactoros\MiaJsonErrorResponse(-2, $exc->getMessage());
        }

        // Devolvemos respuesta
        return new \Mia\Core\Diactoros\MiaJsonResponse($item->toArray());
    }
    
    /**
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return \App\Model\Team
     */
    protected function getForEdit(\Psr\Http\Message\ServerRequestInterface $request)
    {
        // Obtenemos ID si fue enviado
        $itemId = $this->getParam($request, 'id', '');
        // Buscar si existe el item en la DB
        $item = MIAEmailTemplate::find($itemId);
        // verificar si existe
        if($item === null){
            return new MIAEmailTemplate();
        }
        // Devolvemos item para editar
        return $item;
    }
}