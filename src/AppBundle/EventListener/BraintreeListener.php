<?php

namespace AppBundle\EventListener;

use Braintree\Configuration;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

class BraintreeListener
{
    /** @var ContainerInterface */
    private $container;

    function __construct(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        Configuration::environment($this->container->getParameter('app_braintree_environment'));
        Configuration::merchantId($this->container->getParameter('app_braintree_merchantid'));
        Configuration::publicKey($this->container->getParameter('app_braintree_publickey'));
        Configuration::privateKey($this->container->getParameter('app_braintree_privatekey'));
    }
}