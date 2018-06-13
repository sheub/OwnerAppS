<?php

// src/Security/User/WebserviceUserProvider.php
namespace App\Security\User;

use App\Security\User\WebserviceUser;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

// require_once __DIR__ . '/../../../../src/Core/Foundation/Database/EntityInterface.php';
// require_once __DIR__ . '/../../../../classes/ObjectModel.php';
// //abstract class ObjectModel extends \ObjectModelCore {};

// require_once __DIR__ . '/../../../../classes/Tools.php';
// //class Tools extends ToolsCore {};

// require_once __DIR__ . '/../../../../classes/cache/Cache.php';
// //class Cache extends CacheCore {};

// require_once __DIR__ . '/../../../../classes/Employee.php';
// //class Employee extends EmployeeCore {};

// require_once __DIR__ . '/../../../../classes/Context.php';
// //class Context extends ContextCore {};

// require_once __DIR__ . '/../../../../classes/Validate.php';
// //abstract class Validate extends ValidateCore {};

class WebserviceUserProvider implements UserProviderInterface
{
    public function loadUserByUsername($username)
    {
        // make a call to your webservice here
        $userData = '...';
        // pretend it returns an array on success, false if there is no user

        if ($userData) {
            $password = '...';

            // ...

            return new WebserviceUser($username, $password, $salt, $roles);
        }

        throw new UsernameNotFoundException(
            sprintf('Username "%s" does not exist.', $username)
        );
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof WebserviceUser) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return WebserviceUser::class === $class;
    }
}
