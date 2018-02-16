<?php

class UserDao
{
    /**
     * Const USERS_ARRAY
     */
    const USERS_ARRAY = 'users';

    /**
     * Const CURRENT_USER_KEY
     */
    const CURRENT_USER_KEY = 'current_user_key';

    /**
     * @var Memcached
     */
    protected $connexion;

    /**
     * UserDao constructor.
     */
    public function __construct(Memcached $connexionMemcache)
    {
        $this->connexion = $connexionMemcache;
    }

    /**
     * @param $username
     * @return null|User
     */
    public function getUserByUsername($username)
    {
        $usersArray = $this->getUsersArray();
        if (count($usersArray) > 0) {
            foreach ($usersArray as $key => $user) {
                if ($user->getUsername() === $username) {

                    return $user;
                }
            }
        }

        return null;
    }

    /**
     * @return array
     */
    public function getUsersArray()
    {
        $usersArray = $this->connexion->get(self::USERS_ARRAY);
        if (!isset($usersArray) || !$usersArray) {
            $usersArray = [];
        }

        return $usersArray;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function addUser(User $user)
    {
        if ($user->getKey() === null) {
            $user->setKey($this->getCurrentKey());
        }

        $usersArray = $this->getUsersArray();
        $usersArray[] = $user;

        if ($this->connexion->set(self::USERS_ARRAY, $usersArray)) {

            return true;
        }

        return false;
    }

    /**
     * @return int
     */
    public function getCurrentKey()
    {
        $currentKey = $this->connexion->get(self::CURRENT_USER_KEY);
        if (!isset($currentKey) || !$currentKey) {
            $currentId = 0;
            $this->connexion->set(self::CURRENT_USER_KEY, 1);
        } else {
            $currentId = $this->connexion->get(self::CURRENT_USER_KEY);
            $this->connexion->increment(self::CURRENT_USER_KEY);
        }

        return (int) $currentId;
    }
}