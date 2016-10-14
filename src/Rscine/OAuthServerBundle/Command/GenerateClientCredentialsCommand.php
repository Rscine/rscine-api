<?php

namespace Rscine\OAuthServerBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateClientCredentialsCommand extends ContainerAwareCommand
{

    /**
     * @{inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('rscine:oauth-server:client:create')
            ->setDescription('Generate the client credentials for OAuth authentication');
    }

    /**
     * @{inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $oAuthClientManager = $this->getContainer()->get('fos_oauth_server.client_manager.default');
        $client = $oAuthClientManager->createClient();
        $client->setAllowedGrantTypes(array('token', 'authorization_code', 'password', 'refresh_token'));
        $oAuthClientManager->updateClient($client);

        $clientPublicId = $client->getPublicId();
        $output->writeln("Client credentials created - $clientPublicId");
    }
}
