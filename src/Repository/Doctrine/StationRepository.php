<?php
/**
 * Created by PhpStorm.
 * User: Manly
 * Date: 12/05/2018
 * Time: 12:01
 */

namespace App\Repository\Doctrine;

use App\Entity\Station;
use App\Repository\AbstractClass\AbstractRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class StationRepository
 *
 * @author Manly AUSTRIE <austrie.manly@gmail.com>
 */
class StationRepository extends AbstractRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Station::class);
    }

    /**
     *
     * @param float $oldLatitude
     * @param float $oldLongitude
     * @param float $newLatitude
     * @param float $newLongitude
     *
     * @return mixed
     */
    public function getStationNear(float $oldLatitude, float $oldLongitude, float $newLatitude, float $newLongitude)
    {
        $sortLatitude = array($oldLatitude, $newLatitude);
        $sortLongitude = array($oldLongitude, $newLongitude);
        sort($sortLatitude);
        sort($sortLongitude);

        $qb = $this
            ->createQueryBuilder('station')
            ->where('station.latitude BETWEEN :oldLatitute AND :newLatitude')
            ->andWhere('station.longitude BETWEEN :oldLongitude AND :newLongitude')
            ->setParameter('oldLatitute', $sortLatitude[0])
            ->setParameter('newLatitude', $sortLatitude[1])
            ->setParameter('oldLongitude', $sortLongitude[0])
            ->setParameter('newLongitude', $sortLongitude[1])
        ;

        return $qb->getQuery()->getResult();
    }
}
