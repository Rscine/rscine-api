<?php

namespace Rscine\AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Rscine\WorkerBundle\Entity\Genre;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadGenreData implements FixtureInterface, OrderedFixtureInterface {

    private $genres = array(
        'Thunder',
        'Fire',
        'Water',
        'Light',
        'Darkness'
    );

    /**
     *
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->genres as $genreName) {
            $genre = new Genre();
            $genre->setName($genreName);

            $manager->persist($genre);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }

}
