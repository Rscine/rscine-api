<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Department;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadDepartmentData implements FixtureInterface, OrderedFixtureInterface {

    private $departmentNames = array(
        'Hérault' => 34,
        'Gironde' => 33,
        'Lozère' => 48,
        'Pyrénées-Atlantiques' => 64
    );

    /**
     *
     */
    public function load(ObjectManager $manager)
    {

        foreach ($this->departmentNames as $departmentName => $departmentNumber) {
            $department = new Department();
            $department->setName($departmentName);
            $department->setNumber($departmentNumber);
            $manager->persist($department);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }

}
