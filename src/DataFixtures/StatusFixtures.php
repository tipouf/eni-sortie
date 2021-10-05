<?php


namespace App\DataFixtures;

use App\Entity\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StatusFixtures extends Fixture
{
    const STATUS = ["Créée", "Ouverte", "Clôturée", "Activité en cours", "Passée", "Annulée"];

    public function __construct() {
    }

    public function load(ObjectManager $manager)
    {
        foreach (self::STATUS as $str) {
            $status = new Status();
            $status->setLabel($str);
            $manager->persist($status);
        }
        $manager->flush();
    }


}