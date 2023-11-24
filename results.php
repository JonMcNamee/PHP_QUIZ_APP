<?php
session_start();
//gets answers and quiz from showQuestion.php
$quiz = $_SESSION['theQuiz'];
$userAnswers = $_SESSION['userAnswers'];

$questions = $quiz['questions'];
foreach ($questions as $i => $question) {
    if ($userAnswers[$i] == -1) {
        header("Location: errorPage.php");
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>PHP Assignment 2 - Results</title>
</head>
<style>
    h2 {
        background-color: lightblue;
        padding: 10px;
        border: solid thin black;
        border-radius: 5px;
    }

    body {
        background-color: rgb(233, 233, 204);
    }

    p {
        font-weight: bold;
    }

    .submit {
        margin: 10px;
    }

    #question {
        border-top: solid black;
        padding: 15px;
    }

    input {
        margin: 3px;
    }

    .correct {
        background-color: lawngreen;
        font-weight: bold;
    }

    .incorrect {
        background-color: red;
        font-weight: bold;
    }
</style>

<body>

    <?php
    echo "<h2>" . $quiz["title"] . "</h2>";
    $questions = $quiz["questions"];
    $correctAnswers = 0;
    //first loop builds questions
    for ($i = 0; $i < count($questions); $i++) {
        $activeQuestion = $questions[$i];
        $choices = $activeQuestion["choices"];

        $userAnswerIndex = $userAnswers[$i];

        echo "<div id='question'>";
        echo "<p>" . $activeQuestion["questionText"] . "</p>";
        //nested loop builds answers, collects number of correct answers for final score
        for ($j = 0; $j < count($choices); $j++) {
            $activeChoice = $choices[$j];

            echo "<input type='radio' name='options$i' value='$j' disabled>";
            echo "<label>" . $activeChoice . "</label> <br>";
        }

        //if user answer matches correct answer, set class to correct, otherwise set to incorrect
        if ($userAnswerIndex == $activeQuestion["answer"]) {
            $cssClass = "correct";
            $correctAnswers++;
        } else {
            $cssClass = "incorrect";
        }

        //displays user answer and correct answer
        echo "<h4 class='$cssClass'>Your Answer: " . $choices[$userAnswerIndex] . "</h4>";
        echo "<h4>Correct Answer: " . $choices[$activeQuestion["answer"]] . "</h4>";
        echo "</div>";
    }

    echo "<div class = 'counter'>";
    echo "<h2>Final Score: $correctAnswers/$i</h2>";
    echo "</div>";

    ?>
</body>

</html>