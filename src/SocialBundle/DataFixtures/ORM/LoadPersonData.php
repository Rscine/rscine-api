<?php

namespace SocialBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use SocialBundle\Entity\Address;
use SocialBundle\Entity\ContactInformation;
use SocialBundle\Entity\Email;
use SocialBundle\Entity\Person;
use SocialBundle\Entity\Phone;

class LoadPersonData implements FixtureInterface, OrderedFixtureInterface {

    private $persons = array(
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

        foreach ($this->persons as $personItem) {
            $person = new Person();
            $person->setUsername(ucfirst($personItem['name']));
            $person->setPlainPassword($personItem['name']);
            $person->setLogin($personItem['name']);
            $person->setEmail($personItem['name'].'@gmail.com');

            // Company binding
            $company = $manager->getRepository('SocialBundle:Company')->findOneByName($personItem['company']);

            if ($company)
                $person->setCompany($company);

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

            $email->setEmail($personItem['name'].'@'.strtolower($person->getCompany()->getName()).'.com');
            $email->setType('office');

            $contactInformations->addEmail($email);

            // Address binding
            $address = new Address();
            $address->setNumber($personItem['address']);
            $address->setStreet($personItem['company'].' avenue');
            $address->setPostalCode(00000);

            $district = $manager->getRepository('SocialBundle:District')->findOneByNumber($personItem['district']);

            if ($district){
                $address->setDistrict($district);
                $address->setPostalCode(intval($district->getId().'000'));
            }

            $contactInformations->addAddress($address);

            $person->setContactInformation($contactInformations);

            $manager->persist($person);
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
