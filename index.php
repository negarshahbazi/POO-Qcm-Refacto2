<?php
function my_autoload($class){ 
include 'class/' . $class . '.php';  
}
spl_autoload_register('my_autoload');
// require_once('./class/Qcm.php');
// require_once('./class/Question.php');
// require_once('./class/Answer.php');
require_once('./connexion.php');

$qcm = new Qcm($db);
$qcm->getQuestions();
$qcm->generate();
?>



