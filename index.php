<?php

include_once('src/User.class.php');
include_once('src/VoteScore.class.php');
include_once('dao/ConnexionMemcache.class.php');
include_once('dao/UserDao.class.php');
include_once('dao/VoteScoreDao.class.php');
include_once('services/VoteService.class.php');

$connexionMemcache  = new ConnexionMemcache();
$voteService = new VoteService($connexionMemcache->getConnexion());

while(!$voteScore = $voteService->checkVoteTerminate(3)) {

    echo $voteService->getLineReturn(3);
    printf(
        "
         Bienvenue sur le programme de l'élection du plus gros boulet 
         \n\n 
         Quel ignard es tu ? (prenom) 
         \n\n
         "
    );

    $checkUser = $voteService->checkUsername((string) $username = fgets(STDIN));
    if (!$checkUser['state']) {
        die($checkUser['string']);
    }
    echo $checkUser['string'];
    echo $voteService->getLineReturn(4);

    echo $voteService->getStringBiflons();
    printf("\n\n\n Pour quel boulet souhaitez vous voter : ");
    printf("\n\n %s \n\n %s",
        $voteService->checkVote((int) $key = fgets(STDIN)),
        $voteService->getTotalScore()
    );
}

printf(
    "
    Le vote est terminé \n\n 
    Le vainqueur est donc %s avec %s voix \n\n
    ",
    $voteScore->getName(),
    $voteScore->getScore()
);

?>

