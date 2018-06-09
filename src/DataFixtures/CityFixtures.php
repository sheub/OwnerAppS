<?php
/**
 * Created by PhpStorm.
 * User: Manly
 * Date: 12/05/2018
 * Time: 11:03
 */

namespace App\DataFixtures;

use App\Entity\City;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class CityFixtures
 *
 * @author Manly AUSTRIE <austrie.manly@gmail.com>
 */
class CityFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $cityNantes = new City();
        $cityNantes
            ->setActive(true)
            ->setName('Nantes')
            ->setCode('NAN')
            ->setLatitude(47.21725)
            ->setLongitude(1.55336)
            ->addStation($this->getReference(StationFixtures::STA_NAN_REFERENCE))
        ;
        $manager->persist($cityNantes);

        $cityParis = new City();
        $cityParis
            ->setActive(true)
            ->setName('Paris')
            ->setCode('PAR')
            ->setLatitude(48.85341)
            ->setLongitude(2.3488)
            ->addStation($this->getReference(StationFixtures::STA_PAR_REFERENCE))
        ;
        $manager->persist($cityParis);

        $cityGuadeloupe = new City();
        $cityGuadeloupe
            ->setActive(true)
            ->setName('Guadeloupe')
            ->setCode('GUA')
            ->setLatitude(16.99597)
            ->setLongitude(-62.06764)
            ->addStation($this->getReference(StationFixtures::STA_GUA_REFERENCE))
        ;
        $manager->persist($cityGuadeloupe);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 50;
    }
}
