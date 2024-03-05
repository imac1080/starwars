<?php

namespace App\DataFixtures;

use App\Entity\Charecters;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CharectersFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $Charecters = new Charecters();
        $Charecters->setName('Luke Skywalker');
        $Charecters->setMass(77);
        $Charecters->setHeight(172);
        $Charecters->setGender('male');
        $Charecters->setPicture('uploads/65e75e456f181.png');
        

        $manager->persist($Charecters);


        $manager->flush();
    }
}
