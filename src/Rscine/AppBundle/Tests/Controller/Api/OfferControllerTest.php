<?php

namespace Rscine\AppBundle\Tests\Controller;

use Rscine\AppBundle\Entity\Offer;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class OfferControllerTest extends WebTestCase
{

    /**
     * Teste la récupération des offres
     * @return [type] [description]
     */
    public function testGetOffers()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', $client->getContainer()->get('router')->generate('get_offers'));

        $content = $client->getResponse()->getContent();

        $this->assertEquals('200', $client->getResponse()->getStatusCode());
        $this->assertJson($content);
    }

    /**
     * Teste la récupération d'une offre en particulier
     * @return [type] [description]
     */
    public function testGetOneOffer()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', $client->getContainer()->get('router')->generate('get_offer', array('offer' => 8)));

        $content = $client->getResponse()->getContent();

        $this->assertEquals('200', $client->getResponse()->getStatusCode());
        $this->assertJson($content);
    }

    public function testCreateOffer()
    {
        $client = static::createClient();

        $offer = new Offer();
        $offer->setName('Dummy offer !');
        $offer->setDescription('Dummy offer description !');

        $serializer = $client->getContainer()->get('serializer');

        $client->request('POST', $client->getContainer()->get('router')->generate('post_offer', array(
            'appbundle_offer' => $serializer->toArray($offer)
        )));

        $this->assertEquals('200', $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());

    }

    public function testDeleteOffer()
    {
        
    }

    public function testUpdateOffer()
    {
        
    }

}
