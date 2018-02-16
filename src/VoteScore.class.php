<?php

class VoteScore
{
    /**
     * @var int
     */
    private $key;

    /**
     * @var int
     */
    private $score;

    /**
     * @var string
     */
    private $name;

    /**
     * VoteScore constructor.
     * @param int $key
     * @param string $name
     * @param int $score
     */
    public function __construct($key, $name, $score)
    {
        $this->key = $key;
        $this->name = $name;
        $this->score = $score;
    }

    /**
     * @return int
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function addVote()
    {
        return $this->score += 1;
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param $score
     */
    public function setScore($score)
    {
        $this->score = $score;
    }

    /**
     * @return int
     */
    public function getKey()
    {
        return $this->key;
    }
}