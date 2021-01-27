<?php 

declare(strict_types=1);

namespace Mia\Mail\Factory;

use Psr\Container\ContainerInterface;

class SendgridFactory 
{
    public function __invoke(ContainerInterface $container) : \Mia\Mail\Service\Sendgrid
    {
        // Obtenemos configuracion
        $config = $container->get('config')['sendgrid'];
        // creamos libreria
        return new \Mia\Mail\Service\Sendgrid($config);
    }
}