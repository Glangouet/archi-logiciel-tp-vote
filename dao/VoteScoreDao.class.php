<?php

class VoteScoreDao
{

    /**
     * Const VOTE_SCORE_TAB
     */
    const VOTE_SCORE_ARRAY = 'vote_score';

    /**
     * @var Memcached
     */
    protected  $connexion;

    /**
     * VoteScoreDao constructor.
     */
    public function __construct(Memcached $connexion)
    {
        $this->connexion = $connexion;
    }

    /**
     * @param $key
     * @return VoteScore|null
     */
    public function getVoteScoreByKey($key)
    {
        $voteScoreArray = $this->getVoteScoreArray();
        if (array_key_exists($key, $voteScoreArray)) {

            return $voteScoreArray[$key];
        }

        return null;
    }

    /**
     * @return array|string
     */
    public function getVoteScoreArray()
    {
        $voteScoreArray = $this->connexion->get(self::VOTE_SCORE_ARRAY);
        if (!isset($voteScoreArray) || !$voteScoreArray) {
            $voteScoreArray = [];
        }

        return $voteScoreArray;
    }

    /**
     * @param VoteScore $voteScore
     * @return bool
     */
    public function addVoteScore(VoteScore $voteScore)
    {
        $voteScoreArray = $this->getVoteScoreArray();
        $voteScoreArray[$voteScore->getKey()] = $voteScore;
        $this->connexion->set(self::VOTE_SCORE_ARRAY, $voteScoreArray);

        return true;
    }

    /**
     * @param VoteScore $voteScore
     * @return bool
     */
    public function addVote(VoteScore $voteScore)
    {
        $voteScore->addVote();
        $voteScoreArray = $this->getVoteScoreArray();
        $voteScoreArray[$voteScore->getKey()] = $voteScore;

        return $this->connexion->set(self::VOTE_SCORE_ARRAY, $voteScoreArray);
    }
}