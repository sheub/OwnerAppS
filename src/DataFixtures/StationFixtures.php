<?php
/**
 * Created by PhpStorm.
 * User: Manly
 * Date: 12/05/2018
 * Time: 11:10
 */

namespace App\DataFixtures;


use App\Entity\Station;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class StationFixtures
 *
 * @author Manly AUSTRIE <austrie.manly@gmail.com>
 */
class StationFixtures extends Fixture implements OrderedFixtureInterface
{
    public const STA_NAN_REFERENCE = 'station-nantes';
    public const STA_NAN2_REFERENCE = 'station-nantes2';
    public const STA_PAR_REFERENCE = 'station-paris';
    public const STA_GUA_REFERENCE = 'station-guadeloupe';

    public function load(ObjectManager $manager)
    {
        $stations = [
            [
                'name' => 'StationForNantes',
                'code' => 'STA-NAN',
                'latitude' => 47.21725,
                'longitude' => -1.55336,
                'address' => '41 BOULEVARD ALBERT EINSTEIN',
                'bikesCapacity' => 50,
                'bikesAvailable' => 2,
                'reference' => self::STA_NAN_REFERENCE
            ],
            [
                'name' => 'StationForParis',
                'code' => 'STA-PAR',
                'latitude' => 47.21725,
                'longitude' => -1.55336,
                'address' => 'RUE DE LA DEFENSE',
                'bikesCapacity' => 500,
                'bikesAvailable' => 20,
                'reference' => self::STA_PAR_REFERENCE
            ],
            [
                'name' => 'StationForGuadeloupe',
                'code' => 'STA-GUA',
                'latitude' => 47.21725,
                'longitude' => -1.55336,
                'address' => '28 RUE FELIX-EBOUE',
                'bikesCapacity' => 5000,
                'bikesAvailable' => 200,
                'reference' => self::STA_GUA_REFERENCE
            ],
            [
                'name' => 'StationForNantes2',
                'code' => 'STA-NAN2',
                'latitude' => 47.21725,
                'longitude' => -1.55336,
                'address' => '41 BOULEVARD ALBERT EINSTEIN 2',
                'bikesCapacity' => 50000,
                'bikesAvailable' => 2000,
                'reference' => self::STA_NAN2_REFERENCE
            ],
        ];

        foreach ($stations as $station){
            $stationTmp = new Station();
            $stationTmp
                ->setActive(true)
                ->setName($station['name'])
                ->setCode($station['code'])
                ->setLatitude($station['latitude'])
                ->setLongitude($station['longitude'])
                ->setAddress($station['address'])
                ->setBikesCapacity($station['bikesCapacity'])
                ->setBikesAvailable($station['bikesAvailable']);
            $manager->persist($stationTmp);
            $this->addReference($station['reference'], $stationTmp);
        }
        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 45;
    }
}