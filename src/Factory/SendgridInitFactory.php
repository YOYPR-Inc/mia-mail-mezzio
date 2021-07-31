<?php

declare(strict_types=1);

namespace Mia\Mail\Factory;

use Psr\Container\ContainerInterface;

/**
 * Description of SendgridHandlerFactory
 *
 * @author matiascamiletti
 */
class SendgridInitFactory 
{
    public function __invoke(ContainerInterface $container, $requestName)
    {
        // Get service
        $service = $container->get(\Mia\Mail\Service\Sendgrid::class);
        // Generate class
        return new $requestName($service);
    }
}