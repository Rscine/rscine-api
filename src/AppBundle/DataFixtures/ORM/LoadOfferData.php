<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Offer;
use AppBundle\AppBundle;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadOfferData implements FixtureInterface, OrderedFixtureInterface{

    private $offers = array(
        'Take back Neimi' => 'You need to take back Neimi so that she can be with us all along from now on',
        'Join Ephraim' => 'Join Ephraim for his battle against the Lord of Verdaint',
        'Kill Cormag' => 'Chase down and delete Cormag, the vilainous wyvern knight',
        'Save Eirika' => 'Eirika is being hunt by some of the king\'s sbires. Save her at any cost'
    );

    /**
     *
     */
    public function load(ObjectManager $manager)
    {

        foreach ($this->offers as $offerName => $offerDescription) {
            $offer = new Offer();

            $offer->setName($offerName);
            $offer->setDescription($offerDescription);

            $applicants = $manager->getRepository('AppBundle:Contractor')->findAll();

            foreach ($applicants as $applicant) {
                $offer->addApplicant($applicant);
                $manager->persist($applicant);
            }

            $creator = $manager->getRepository('AppBundle:Customer')->findOneByUsername('Eirika');

            $offer->setCreator($creator);

            $handler = $manager->getRepository('AppBundle:Contractor')->findOneByUsername('Cormag');

            $offer->setHandler($handler);
                
            $manager->persist($creator);
            $manager->persist($handler);
            $manager->persist($offer);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 5;
    }

}
