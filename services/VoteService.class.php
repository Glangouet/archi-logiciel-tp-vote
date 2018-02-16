<?php

class VoteService
{
    /**
     * @var UserDao
     */
    protected $userDao;

    /**
     * @var VoteScoreDao
     */
    protected $voteScoreDao;

    /**
     * VoteService constructor.
     */
    public function __construct(Memcached $connexionMemcache)
    {
        $this->userDao = new UserDao($connexionMemcache);
        $this->voteScoreDao = new VoteScoreDao($connexionMemcache);
    }

    /**
     * @return array
     */
    public function getBiflons()
    {
        return [
            1 => "Marin plepen",
            2 => "Macaron",
            3 => "Michan'chmon",
            4 => "Pinel Jospa",
            5 => "Jock chikeur"
        ];
    }

    /**
     * @return string
     */
    public function getStringBiflons()
    {
        $biflons = $this->getBiflons();
        $biflonsStr = '';
        foreach ($biflons as $key => $bifleur) {
            $biflonsStr .= sprintf("Taper %s pour => %s \n", $key, $bifleur);
        }

        return $biflonsStr;
    }

    /**
     * @param $username
     * @return array
     */
    public function checkUsername($username)
    {
        if ($username) {
            $user = $this->userDao->getUserByUsername($username);
            if (null !== $user) {

                return [
                    'string' =>
                        "\n\n ok c'est bon je t'ai reconnu tu es "
                        . $user->getUsername() .
                        " Change de pseudo si tu veux hacker le systeme boulet ! \n\n",
                    'state' => false
                ];
            } else {
                $user = new User(null, $username);
                if ($this->userDao->addUser($user)) {

                    return [
                        'string' => "\n\n ok tes un newbi c'est good " . $user->getUsername(),
                        'state' => true
                    ];
                }

                die('Probleme survenue addUser');
            }
        }

        die('pas d\'username renseigné');
    }

    /**
     * @param $nb
     * @return string
     */
    public function getLineReturn($nb)
    {
        $str = "";
        for ($i = 1; $i < $nb; $i++) {
            $str .= "\n";
        }

        return $str;
    }

    /**
     * @param $key
     * @return string
     */
    public function checkVote($key)
    {
        $biflons = $this->getBiflons();
        if (array_key_exists($key, $biflons)) {
            if ($voteScore = $this->voteScoreDao->getVoteScoreByKey($key)) {
                if ($this->voteScoreDao->addVote($voteScore)) {

                    return 'OK good pour ton vote pour le '. $biflons[$key];
                }

                return 'Probleme survenu lors de l\'ajout du vote';
            }

            $voteScore = new VoteScore($key, $biflons[$key], 1);
            if ($this->voteScoreDao->addVoteScore($voteScore)) {

                return 'OK good pour ton vote pour le '. $biflons[$key];
            }

            return 'Probleme survenue lors de l\'ajout du vote score';
        }

        return 'Ce bifleur n\'existe pas';
    }

    /**
     * @return string
     */
    public function getTotalScore()
    {
        $voteScoreArray = $this->voteScoreDao->getVoteScoreArray();
        $str = "Score total: \n\n";
        foreach ($voteScoreArray as $voteScore) {
            /** @var VoteScore $voteScore */
            $str .= $voteScore->getName() . " obtient " . $voteScore->getScore() . " voix de mongoliens qui pensent que les choses vont changer \n";
        }

        return $str;
    }

    /**
     * @param int $limit
     * @return bool|VoteScore
     */
    public function checkVoteTerminate($limit)
    {
        $voteScoreArray = $this->voteScoreDao->getVoteScoreArray();
        foreach ($voteScoreArray as $voteScore) {
            /** @var VoteScore $voteScore */
            if ($voteScore->getScore() === $limit) {

                return $voteScore;
            }
        }

        return false;
    }
}