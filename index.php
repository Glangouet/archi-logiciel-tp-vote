<?php

include_once('model/User.class.php');
include_once('model/VoteScore.class.php');
include_once('model/Survey.class.php');
include_once('dao/Connexion.class.php');
include_once('dao/UserDao.class.php');
include_once('dao/VoteScoreDao.class.php');
include_once('dao/SurveyDao.class.php');
include_once('services/VoteService.class.php');
include_once('services/SurveyService.class.php');
include_once('services/PromptService.class.php');

$connexion  = new Connexion();
$promptService = new PromptService();
$voteService = new VoteService($connexion->getConnexion());
$surveyService = new SurveyService($connexion->getConnexion());

echo $promptService->getLineReturn(3);
printf(
    "
             Bienvenue, que souhaitez vous effectuer ? 
             \n\n 
             1 - Créer un sondage
             2 - Participer à un sondage
             3 - Modifier mon/mes choix à un sondage
             4 - Voter pour un enfoiré
             5 - Quitter
           "
);

if ($choice = fgets(STDIN)) {
    while ((int) $choice != 5) {
        if ($choice > 0 && $choice <= 4) {
            switch ($choice) {
                case 1:
                    echo 'Créer un sondage';
                    break;
                case 2:
                    echo 'Participer à un sondage';
                    break;
                case 3:
                    echo 'Modifier mon/mes choix à un sondage';
                    break;
                case 4:
                    echo 'Voter pour un enfoiré';
                    break;
            }
            echo $promptService->getLineReturn(2);
        } else {
            echo 'Choix pas terrible man..';
            echo $promptService->getLineReturn(2);
        }
        $choice = fgets(STDIN);
    }
    echo $promptService->getLineReturn(3);
    echo 'Vous quittez le programme.';
    echo $promptService->getLineReturn(3);
}

//
//
//while(!$voteScore = $voteService->checkVoteTerminate(3)) {
//
//    echo $voteService->getLineReturn(3);
//    printf(
//        "
//         Bienvenue sur le programme de l'élection du plus gros boulet
//         \n\n
//         Quel ignard es tu ? (prenom)
//         \n\n
//         "
//    );
//
//    $checkUser = $voteService->checkUsername((string) $username = fgets(STDIN));
//    if (!$checkUser['state']) {
//        die($checkUser['string']);
//    }
//    echo $checkUser['string'];
//    echo $voteService->getLineReturn(4);
//
//    echo $voteService->getStringBiflons();
//    printf("\n\n\n Pour quel boulet souhaitez vous voter : ");
//    printf("\n\n %s \n\n %s",
//        $voteService->checkVote((int) $key = fgets(STDIN)),
//        $voteService->getTotalScore()
//    );
//}
//
//printf(
//    "
//    Le vote est terminé \n\n
//    Le vainqueur est donc %s avec %s voix \n\n
//    ",
//    $voteScore->getName(),
//    $voteScore->getScore()
//);

?>
