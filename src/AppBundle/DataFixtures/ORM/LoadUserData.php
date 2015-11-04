<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class LoadUserData implements FixtureInterface {

    private $usernames = array(
        'monzey' => 33,
        'jeanbono' => 34,
        'aligator' => 48,
        'melanizetofrais' => 68
    );

    /**
     *
     */
    public function load(ObjectManager $manager)
    {

        foreach ($this->usernames as $username => $departmentNumber) {
            $user = new User();
            $user->setUsername(ucfirst($username));
            $user->setPlainPassword($username);
            $user->setLogin($username);
            $user->setEmail($username.'@gmail.com');

            $department = $manager->getRepository('AppBundle:Department')->findOneByNumber($departmentNumber);

            if ($department)
                $user->setDepartment($department);

            $manager->persist($user);
        }

        $manager->flush();
    }

}
