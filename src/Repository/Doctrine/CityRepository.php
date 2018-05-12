<?php
/**
 * Created by PhpStorm.
 * User: Manly
 * Date: 12/05/2018
 * Time: 12:01
 */

namespace App\Repository\Doctrine;

use App\Entity\City;
use App\Repository\AbstractClass\AbstractRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class CityRepository
 *
 * @author Manly AUSTRIE <austrie.manly@gmail.com>
 */
class CityRepository extends AbstractRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, City::class);
    }

    /**
     *
     * @param string $order
     * @param int $limit
     * @param int $offset
     * @return \Pagerfanta\Pagerfanta
     *
     *
     */
    public function search(string $order = 'asc', int $limit = 20, int $offset = 0)
    {
        $qb = $this
            ->createQueryBuilder('city')
            ->select('city')
            ->orderBy('city.name', $order)
        ;

        return $this->paginate($qb, $limit, $offset);
    }
}
