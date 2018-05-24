<?php
/**
 * Created by PhpStorm.
 * User: Manly
 * Date: 12/05/2018
 * Time: 12:01
 */

namespace App\Repository\Doctrine;

use App\Entity\User;
use App\Repository\AbstractClass\AbstractRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class UserRepository
 *
 * @author Manly AUSTRIE <austrie.manly@gmail.com>
 */
class UserRepository extends AbstractRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }
}
