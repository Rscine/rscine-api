<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Domain;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadDomainData implements FixtureInterface, OrderedFixtureInterface {

    private $domains = array(
        'Sword',
        'Axe',
        'Spear',
        'Book',
        'Staff',
        'Bow',
        'None'
    );

    /**
     *
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->domains as $key => $domainName) {
            $domain = new Domain();

            $domain->setName($domainName);

            $offset = $key;
            $limit = $offset + 3;

            $availableGenres = $manager->getRepository('AppBundle:Genre')->findBy(array(), null, $limit, $offset);


            $availableProfiles = $manager->getRepository('AppBundle:Profile')->findBy(array(), null, $limit, $offset);

            foreach ($availableGenres as $genre) {
                $domain->addAvailableGenre($genre);
            }

            foreach ($availableProfiles as $profile) {
                $domain->addAvailableProfile($profile);
            }

            $manager->persist($domain);

        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 8;
    }

}
