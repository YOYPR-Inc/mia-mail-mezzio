<?php namespace Mia\Mail\Service;

class Sendgrid extends BaseService
{
    /**
     *
     * @var \SendGrid
     */
    public $apiInstance = null;

    public function sendWithoutTemplate($addTo, $subject, $contentHtml, $contentText = '')
    {
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom($this->from, $this->name);
        $email->setSubject($subject);
        $email->addTo($addTo);
        $email->addContent(
            "text/html", $contentHtml
        );
        
        // Asignamos si contiene email puro texto.
        if($contentText != ''){
            $email->addContent("text/plain", $contentText);
        }
        // Enviamos Email
        try {
            return $this->apiInstance->send($email);
        } catch (\Exception $th) {
            return false;
        }
    }
    
    public function send($addTo, $templateSlug, $params)
    {
        $template = $this->getTemplate($templateSlug);

        if($template == null){
            return false;
        }

        $email = new \SendGrid\Mail\Mail();
        $email->setFrom($this->from, $this->name);
        $email->setSubject($template->subject);
        $email->addTo($addTo);
        $email->addContent(
            "text/html", $this->processParams($template->content, $params)
        );
        
        // Asignamos si contiene email puro texto.
        if($template->content_text != ''){
            $email->addContent("text/plain", $this->processParams($template->content_text, $params));
        }
        // Enviamos Email
        try {
            return $this->apiInstance->send($email);
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    public function sendHtml($addTo, $subject, $html, $plain = '')
    {
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom($this->from, $this->name);
        $email->setSubject($subject);
        $email->addTo($addTo);
        $email->addContent(
            "text/html", $html
        );
        
        // Asignamos si contiene email puro texto.
        if($plain != ''){
            $email->addContent("text/plain", $plain);
        }
        // Enviamos Email
        try {
            return $this->apiInstance->send($email);
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    /**
     * Funcion que se encarga de crear el servicio
     * @return boolean
     */
    protected function createService()
    {
        // Verificamos que se haya cargado una API_KEY
        if($this->apiKey == ''){
            return false;
        }
        // Creamos el servicio
        $this->apiInstance = new \SendGrid($this->apiKey);
    }

    /**
     * 
     * @return \SendGrid 
     */
    public function getService()
    {
        return $this->apiInstance;
    }
}