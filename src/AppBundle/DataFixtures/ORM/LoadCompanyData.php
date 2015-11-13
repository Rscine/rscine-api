<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Company;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadCompanyData implements FixtureInterface, OrderedFixtureInterface {

    private $companies = array(
        'Renais',
        'Frelia',
        'Carcino',
        'Rausten'
    );

    /**
     *
     */
    public function load(ObjectManager $manager)
    {

        foreach ($this->companies as $companyName) {
            $company = new Company();
            $company->setSiret(uniqid());
            $company->setName($companyName);

            $manager->persist($company);
        }

        $manager->flush();
    }

    public function getOrder()  
    {
        return 2;
    }

}
