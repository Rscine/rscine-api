<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Contractor;

class LoadContractorData implements FixtureInterface {

    private $usernames = array(
        'cormag' => 33,
        'neimi' => 34,
        'colm' => 48,
        'gerrik' => 64
    );

    /**
     *
     */
    public function load(ObjectManager $manager)
    {

        foreach ($this->usernames as $username => $departmentNumber) {
            $user = new Contractor();
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
