<?php

namespace Mia\Mail\Helper;

use Mia\Mail\Service\Sendgrid;

/**
 * Description of ListHandler
 *
 * @author matiascamiletti
 */
trait SendgridHandlerHelper
{
    /**
     * @var Sendgrid
     */
    protected $sendgrid;

    public function getSendgrid(\Psr\Http\Message\ServerRequestInterface $request): Sendgrid
    {
        if($this->sendgrid === null){
            $this->sendgrid = $request->getAttribute('Sendgrid');
        }
        return $this->sendgrid;
    }
}