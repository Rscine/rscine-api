<?php

namespace SocialBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SocialBundle\Entity\Profile;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadProfileData implements FixtureInterface, OrderedFixtureInterface {

    private $profiles = array(
        'Thief',
        'Hero',
        'Warrior',
        'Berzerker',
        'General',
        'Wyvern Knight',
        'Valkyrie',
        'Sage',
        'Mage',
        'Sniper',
        'Ranger',
        'Manakete',
        'Dancer',
    );

    /**
     *
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->profiles as $profileName) {
            $profile = new Profile();
            $profile->setName($profileName);

            $manager->persist($profile);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }

}
