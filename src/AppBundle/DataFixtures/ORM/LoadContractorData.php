<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Contractor;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadContractorData implements FixtureInterface, OrderedFixtureInterface {

    private $users = array(
        array(
            'name' => 'cormag',
            'department' => 33,
            'company' => 'Rausten'
        ),
        array(
            'name' => 'neimi',
            'department' => 34,
            'company' => 'Rausten'
        ),
        array(
            'name' => 'colm',
            'department' => 48,
            'company' => 'Frelia'
        ),
        array(
            'name' => 'gerrik',
            'department' => 64,
            'company' => 'Renais'
        )
    );

    /**
     *
     */
    public function load(ObjectManager $manager)
    {

        foreach ($this->users as $userItem) {
            $user = new Contractor();
            $user->setUsername(ucfirst($userItem['name']));
            $user->setPlainPassword($userItem['name']);
            $user->setLogin($userItem['name']);
            $user->setEmail($userItem['name'].'@gmail.com');

            $department = $manager->getRepository('AppBundle:Department')->findOneByNumber($userItem['department']);

            if ($department)
                $user->setDepartment($department);

            $company = $manager->getRepository('AppBundle:Company')->findOneByName($userItem['company']);

            if ($company)
                $user->setCompany($company);

            $manager->persist($user);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }

}
