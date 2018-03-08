<?php

class SurveyDao
{
    /**
     * Const SURVEY_ARRAY
     */
     const SURVEY_ARRAY = 'survey';

    /**
     * @var Memcache
     */
    private $connexion;

    /**
     * SurveyDao constructor.
     * @param Memcached $connexion
     */
    public function __construct(Memcached $connexion)
    {
        $this->connexion = $connexion;
    }


}