<?php
$fileName = $_POST["quizChoice"];
$file = fopen($fileName, "r") or die("cannot find quiz");
$fileContents = fread($file, filesize($fileName));
fclose($file);

$data = json_decode($fileContents, true); // Decode JSON data into an array

session_start();
$_SESSION['theQuiz'] = $data;
//creates required variables for monitoring question and answer indices
$_SESSION['CQ'] = 0;

$userAnswers = array();
for ($i = 0; $i < count($data['questions']); $i++) {
    array_push($userAnswers, -1);
}
$_SESSION['userAnswers'] = $userAnswers;

echo var_dump($userAnswers);
//loads quiz page
header("Location: showQuestion.php");
