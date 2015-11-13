<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Customer;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadCustomerData implements FixtureInterface, OrderedFixtureInterface {

    private $usernames = array(
        'eirika' => 33,
        'ephraim' => 34,
        'duessel' => 48,
        'frantz' => 64
    );

    /**
     *
     */
    public function load(ObjectManager $manager)
    {

        foreach ($this->usernames as $username => $departmentNumber) {
            $user = new Customer();
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

    public function getOrder()
    {
        return 1;
    }

}
