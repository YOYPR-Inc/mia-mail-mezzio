<?php namespace Mia\Mail\Service;

class Sendgrid extends BaseService
{
    /**
     *
     * @var \SendinBlue\Client\Api\SMTPApi
     */
    public $apiInstance = null;
    
    public function send($addTo, $templateSlug, $params)
    {
        $template = $this->getTemplate($templateSlug);

        $email = new \SendGrid\Mail\Mail();
        $email->setFrom($this->from, $this->name);
        $email->setSubject($template->subject);
        $email->addTo($addTo);
        $email->addContent(
            "text/html", $this->processParams($template->content, $params)
        );
        
        // Asignamos si contiene email puro texto.
        if($template->content_text != ''){
            $email->addContent("text/plain", $$this->processParams($template->content_text, $params));
        }
        // Enviamos Email
        return $this->service->send($email);    
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