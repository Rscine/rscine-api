<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class LoadUserData implements FixtureInterface {

    private $usernames = array(
        'monzey',
        'jeanbono',
        'aligator',
        'melanizetofrais'
    );

    /**
     *
     */
    public function load(ObjectManager $manager)
    {

        foreach ($this->usernames as $username) {
            $user = new User();
            $user->setUsername(ucfirst($username));
            $user->setPlainPassword($username);
            $user->setLogin($username);
            $user->setEmail($username.'@gmail.com');

            $manager->persist($user);
        }

        $manager->flush();
    }

}
