<?php

declare(strict_types=1);

namespace Mia\Mail\Factory;

use Psr\Container\ContainerInterface;

/**
 * Description of SendgridHandlerFactory
 *
 * @author matiascamiletti
 */
class SendgridHandlerFactory 
{
    public function __invoke(ContainerInterface $container) : \Mia\Mail\Handler\SendgridHandler
    {
        // Creamos servicio
        $service   = $container->get(\Mia\Mail\Service\Sendgrid::class);
        // Generamos el handler
        return new \Mia\Mail\Handler\SendgridHandler($service);
    }
}