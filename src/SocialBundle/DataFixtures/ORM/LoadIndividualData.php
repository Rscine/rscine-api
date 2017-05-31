<?php

namespace SocialBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use SocialBundle\Entity\Address;
use SocialBundle\Entity\ContactInformation;
use SocialBundle\Entity\Email;
use SocialBundle\Entity\Individual;
use SocialBundle\Entity\Phone;

class LoadIndividualData implements FixtureInterface, OrderedFixtureInterface {

    private $individuals = array(
        array(
            'name' => 'cormag',
            'district' => 33,
            'address' => '78',
            'company' => 'Rausten',
        ),
        array(
            'name' => 'neimi',
            'district' => 34,
            'address' => '98',
            'company' => 'Rausten',
        ),
        array(
            'name' => 'colm',
            'district' => 48,
            'address' => '4898',
            'company' => 'Rausten',
        ),
        array(
            'name' => 'gerrik',
            'district' => 64,
            'address' => '7',
            'company' => 'Frelia',
        ),
        array(
            'name' => 'eirika',
            'district' => 33,
            'address' => '78',
            'company' => 'Renais',
        ),
        array(
            'name' => 'ephraim',
            'district' => 34,
            'address' => '164',
            'company' => 'Renais',
        ),
        array(
            'name' => 'duessel',
            'district' => 48,
            'address' => '135',
            'company' => 'Frelia',
        ),
        array(
            'name' => 'frantz',
            'district' => 64,
            'address' => '1',
            'company' => 'Frelia',
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

            // Company binding
            $company = $manager->getRepository('RscineWorkerBundle:Company')->findOneByName($individualItem['company']);

            if ($company)
                $individual->setCompany($company);

            // Contact informations binding
            $contactInformations = new ContactInformation();

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

            // Address binding
            $address = new Address();
            $address->setNumber($individualItem['address']);
            $address->setStreet($individualItem['company'].' avenue');
            $address->setPostalCode(00000);

            $district = $manager->getRepository('RscineWorkerBundle:District')->findOneByNumber($individualItem['district']);

            if ($district){
                $address->setDistrict($district);
                $address->setPostalCode(intval($district->getId().'000'));
            }

            $contactInformations->addAddress($address);

            $individual->setContactInformation($contactInformations);

            $manager->persist($individual);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 7;
    }

    /**
     * Génère un numéro de téléphone à 10 chiffres
     * @param  [type] $digits [description]
     * @return [type]         [description]
     */
    private function generateRandomPhoneNumber($digits = 9)
    {
        return '0'.str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
    }

}
