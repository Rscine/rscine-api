<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Individual;
use AppBundle\Entity\ContactInformations;
use AppBundle\Entity\Phone;
use AppBundle\Entity\Email;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadIndividualData implements FixtureInterface, OrderedFixtureInterface {

    private $individuals = array(
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
            'company' => 'Rausten'
        ),
        array(
            'name' => 'gerrik',
            'department' => 64,
            'company' => 'Frelia'
        ),
        array(
            'name' => 'eirika',
            'department' => 33,
            'company' => 'Renais'
        ),
        array(
            'name' => 'ephraim',
            'department' => 34,
            'company' => 'Renais'
        ),
        array(
            'name' => 'duessel',
            'department' => 48,
            'company' => 'Frelia'
        ),
        array(
            'name' => 'frantz',
            'department' => 64,
            'company' => 'Frelia'
        )
    );

    /**
     *
     */
    public function load(ObjectManager $manager)
    {

        foreach ($this->individuals as $individualItem) {
            $individual = new Individual();
            $individual->setUsername(ucfirst($individualItem['name']));
            $individual->setPlainPassword($individualItem['name']);
            $individual->setLogin($individualItem['name']);
            $individual->setEmail($individualItem['name'].'@gmail.com');

            // Department binding
            $department = $manager->getRepository('AppBundle:Department')->findOneByNumber($individualItem['department']);

            if ($department)
                $individual->setDepartment($department);

            // Company binding
            $company = $manager->getRepository('AppBundle:Company')->findOneByName($individualItem['company']);

            if ($company)
                $individual->setCompany($company);

            // Contact informations binding
            $contactInformations = new ContactInformations();

            for ($i=0; $i < 4; $i++) { 

                $phoneNumber = $this->generateRandomPhoneNumber();

                $phone = new Phone();

                $phone->setNumber($phoneNumber);
                $phone->setType('mobile');

                $contactInformations->addPhone($phone);

            }

            $email = new Email();

            $email->setEmail($individualItem['name'].'@'.strtolower($individual->getCompany()->getName()).'.com');
            $email->setType('office');

            $contactInformations->addEmail($email);

            $individual->setContactInformations($contactInformations);

            $manager->persist($individual);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }

    /**
     * Génère un numéro de téléphone à 10 chiffres
     * @param  [type] $digits [description]
     * @return [type]         [description]
     */
    private function generateRandomPhoneNumber($digits = 10)
    {
        return str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
    }

}
