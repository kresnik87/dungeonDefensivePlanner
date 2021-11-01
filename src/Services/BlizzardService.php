<?php

namespace App\Services;

use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use \Dalaenir\API\Blizzard\Client;

class BlizzardService
{
    protected $logger;
    protected $client;
    protected $container;

    /**
     * @param LoggerInterface $logger
     * @param HttpClientInterface $client
     * @param ContainerBagInterface $container
     */
    public function __construct(LoggerInterface $logger, ContainerBagInterface $container,string $clientSecret,string $clientId)
    {
        $this->logger = $logger;
        $this->container = $container;
        $this->client = new Client($clientSecret,$clientId,'eu');

    }


}
