<?php
/**
 * Created by PhpStorm.
 * User: Manly
 * Date: 12/05/2018
 * Time: 12:01
 */

namespace App\Repository\Doctrine;

use App\Repository\AbstractClass\AbstractRepository;

/**
 * Class CityRepository
 *
 * @author Manly AUSTRIE <austrie.manly@gmail.com>
 */
class CityRepository extends AbstractRepository
{

    /**
     *
     * @param string $order
     * @param int $limit
     * @param int $offset
     * @return \Pagerfanta\Pagerfanta
     *
     *
     */
    public function search($order = 'asc', $limit = 20, $offset = 0)
    {
        $qb = $this
            ->createQueryBuilder('city')
            ->select('city')
            ->orderBy('city.name', $order)
        ;

        return $this->paginate($qb, $limit, $offset);
    }
}
