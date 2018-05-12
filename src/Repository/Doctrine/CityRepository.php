<?php
/**
 * Created by PhpStorm.
 * User: Manly
 * Date: 12/05/2018
 * Time: 12:01
 */

namespace App\Repository\Doctrine;


use App\Entity\City;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class CityRepository
 * @package App\Controller
 *
 * @author Manly AUSTRIE <austrie.manly@gmail.com>
 */
class CityRepository extends ServiceEntityRepository
{

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, City::class);
    }

}
