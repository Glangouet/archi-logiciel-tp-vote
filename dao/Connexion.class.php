<?php

class Connexion
{
    const MEMCACHE_ADDRESS = "127.0.0.1";
    const MEMCACHE_PORT = 11211;

    /**
     * @return Memcached
     */
    public function getConnexion()
    {
        $connexion = new Memcached();
        $connexion->addServer(self::MEMCACHE_ADDRESS, self::MEMCACHE_PORT);

        return $connexion;
    }
}