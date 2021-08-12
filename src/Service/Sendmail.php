<?php namespace Mia\Mail\Service;

use Laminas\Mail;
use Laminas\Mail\Message;
use Laminas\Mime\Message as MimeMessage;
use Laminas\Mime\Mime;
use Laminas\Mime\Part as MimePart;

class Sendmail extends BaseService
{
    public function sendWithoutTemplate($addTo, $subject, $contentHtml, $contentText = '')
    {
        $mail = new Mail\Message();
        $mail->setFrom($this->from, $this->name);
        $mail->setSubject($subject);
        $mail->addTo($addTo);
        
        $html = new MimePart($contentHtml);
        $html->type = Mime::TYPE_HTML;
        $html->charset = 'utf-8';
        $html->encoding = Mime::ENCODING_QUOTEDPRINTABLE;

        $body = new MimeMessage();

        if($contentText != ''){
            $text = new MimePart($contentText);
            $text->type = Mime::TYPE_TEXT;
            $text->charset = 'utf-8';
            $text->encoding = Mime::ENCODING_QUOTEDPRINTABLE;

            $body->setParts([$text, $html]);
        } else {
            $body->setParts([$html]);
        }        

        $message = new Message();
        $message->setBody($body);

        //$contentTypeHeader = $message->getHeaders()->get('Content-Type');
        //$contentTypeHeader->setType('multipart/alternative');

        $mail->setBody($message);

        // Enviamos Email
        try {
            $transport = new Mail\Transport\Sendmail();
            $transport->send($mail);
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

        $mail = new Mail\Message();
        $mail->setFrom($this->from, $this->name);
        $mail->setSubject($template->subject);
        $mail->addTo($addTo);
        
        $html = new MimePart($this->processParams($template->content, $params));
        $html->type = Mime::TYPE_HTML;
        $html->charset = 'utf-8';
        $html->encoding = Mime::ENCODING_QUOTEDPRINTABLE;

        $body = new MimeMessage();

        if($template->content_text != ''){
            $text = new MimePart($this->processParams($template->content_text, $params));
            $text->type = Mime::TYPE_TEXT;
            $text->charset = 'utf-8';
            $text->encoding = Mime::ENCODING_QUOTEDPRINTABLE;

            $body->setParts([$text, $html]);
        } else {
            $body->setParts([$html]);
        }        

        $message = new Message();
        $message->setBody($body);

        //$contentTypeHeader = $message->getHeaders()->get('Content-Type');
        //$contentTypeHeader->setType('multipart/alternative');

        $mail->setBody($message);

        // Enviamos Email
        try {
            $transport = new Mail\Transport\Sendmail();
            $transport->send($mail);
        } catch (\Exception $th) {
            return false;
        }
    }

    /**
     * Funcion que se encarga de crear el servicio
     * @return boolean
     */
    protected function createService()
    {
    }
}