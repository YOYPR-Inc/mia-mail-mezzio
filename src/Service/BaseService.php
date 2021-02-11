<?php namespace Mia\Mail\Service;

use Mia\Mail\Model\MIAEmailTemplate;

abstract class BaseService
{
    /**
     *
     * @var string
     */
    public $apiKey = '';
    /**
     *
     * @var string
     */
    public $from = 'no-reply@agencycoda.com';
    /**
     *
     * @var string
     */
    public $name = 'AgencyCoda';
    /**
     *
     * @var string
     */
    public $replyTo = '';
    /**
     * URL Base para las imagenes
     * @var string
     */
    public $baseUrl = '';

    public function __construct($config)
    {
        // Setear configuración inicial
        $this->setConfig($config);
        // Creamos el servicio
        $this->createService();
    }
    
    public function getTemplate($slug)
    {
        return MIAEmailTemplate::where('slug', $slug)->first();
    }

    public function processParams($contentHtml, $vars)
    {
        return $this->processArrayParams($contentHtml, '', array_merge(
            [
                'baseUrl' => $this->baseUrl
            ],
            $vars
        ));
    }

    protected function processArrayParams($contentHtml, $varName, $vars)
    {
        foreach($vars as $subVarName => $varValue){
            if(is_array($varValue)){
                $contentHtml = $this->processArrayParams($contentHtml, $varName . $subVarName . '.', $varValue);
            } else {
                $contentHtml = $this->processOneParam($contentHtml, $varName . $subVarName, $varValue);
            }
        }
        return $contentHtml;
    }

    protected function processOneParam($contentHtml, $varName, $varValue)
    {
        return str_replace('{{' . $varName .'}}', $varValue, $contentHtml);
    }

    /**
     * Funcion que se encarga de crear el servicio
     * @return boolean
     */
    abstract protected function createService();

    abstract public function send($addTo, $templateSlug, $params);

    /**
     * Funcion que se encarga de obtener los parametros necesarios
     * @param array $config
     */
    public function setConfig($config)
    {
        if(array_key_exists('api_key', $config)){
            $this->apiKey = $config['api_key'];
        }
        if(array_key_exists('from', $config)){
            $this->from = $config['from'];
        }
        if(array_key_exists('name', $config)){
            $this->name = $config['name'];
        }
        if(array_key_exists('reply_to', $config)){
            $this->replyTo = $config['reply_to'];
        }
        if(array_key_exists('base_url', $config)){
            $this->baseUrl = $config['base_url'];
        }
    }
}