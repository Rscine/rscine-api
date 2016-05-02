<?php

namespace Rscine\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Rscine\WorkerBundle\Entity\Company;
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
            $company->setUsername(ucfirst($companyName));
            $company->setPlainPassword($companyName);
            $company->setLogin(strtolower($companyName));
            $company->setEmail(strtolower($companyName).'@gmail.com');
            $company->setSiret(md5(uniqid(rand(), true)));
            $company->setName($companyName);

            $manager->persist($company);
        }

        $manager->flush();
    }

    public function getOrder()  
    {
        return 1;
    }

}
