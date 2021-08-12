<?php

declare(strict_types=1);

namespace Mia\Mail\Factory;

use Mia\Mail\Service\Sendmail;
use Psr\Container\ContainerInterface;

/**
 * Description of SendgridHandlerFactory
 *
 * @author matiascamiletti
 */
class SendmailInitFactory 
{
    public function __invoke(ContainerInterface $container, $requestName)
    {
        // Obtenemos configuracion
        $config = $container->get('config')['sendgrid'];
        // Generate service
        $sendmail = new Sendmail($config);
        // Generate class
        return new $requestName($sendmail);
    }
}