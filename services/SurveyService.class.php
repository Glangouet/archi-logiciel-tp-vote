<?php

class SurveyService
{
    /**
     * @var UserDao
     */
    protected $userDao;

    /**
     * @var SurveyDao
     */
    protected $surveyDao;

    /**
     * SurveyService constructor.
     * @param Memcached $memcached
     */
    public function __construct(Memcached $memcached)
    {
        $this->userDao = new UserDao($memcached);
        $this->surveyDao = new SurveyDao($memcached);
    }
}