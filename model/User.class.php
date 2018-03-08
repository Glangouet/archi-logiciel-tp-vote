<?php

class User {

    /**
     * @var int
     */
    public $key;

    /**
     * @var string
     */
    public $username;

    /**
     * User constructor.
     * @param $key
     * @param $username
     */
    public function __construct($key, $username)
    {
        $this->key = $key;
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }
}