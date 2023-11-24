<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>PHP Assignment 2 - Quiz App Improved</title>
</head>
<style>
    h1 {
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
</style>

<body>
    <?php
    session_start();
    // Retrieves quiz data from buildQuiz.php
    $quiz = $_SESSION['theQuiz'];
    $CQ = $_SESSION['CQ'];
    updateUA($CQ);
    $userAnswers = $_SESSION['userAnswers'];
    // Checks which button was pressed
    if (isset($_POST['next'])) {
        $CQ++;
        $_SESSION['CQ'] = $CQ;
    } elseif (isset($_POST['previous'])) {
        $CQ--;
        $_SESSION['CQ'] = $CQ;
    } elseif (isset($_POST['done'])) {
        updateUA($CQ);
        header("Location: results.php");
    }
    // Checks if the index is within bounds
    if ($CQ >= 0 && $CQ < count($quiz['questions'])) {
        // Displays current question
        $currentQuestion = $quiz['questions'][$CQ];
        echo '<h1>Question ' . ($CQ + 1) . '</h1>';
        echo '<p>' . $currentQuestion['questionText'] . '</p>';
        echo '<form method="POST" action="showQuestion.php">';
        echo '<input type="hidden" name="questionNumber" value="' . $CQ . '">';

        for ($i = 0; $i < count($currentQuestion['choices']); $i++) {
            $radValue = $i;
            if ($userAnswers[$CQ] == $radValue) {
                $checked = 'checked';
            } else {
                $checked = '';
            }
            echo "<input type='radio' name='question{$CQ}' value='{$i}' $checked>";
            echo $currentQuestion['choices'][$i];
            echo '<br>';
        }
        // Creates nav buttons that are disabled at first and last respectively
        if ($CQ > 0) {
            echo '<input type="submit" name="previous" value="Previous">';
        } else {
            echo '<input type="submit" name="previous" value="Previous" disabled>';
        }

        if ($CQ < count($quiz['questions']) - 1) {
            echo '<input type="submit" name="next" value="Next">';
        } else {
            echo '<input type="submit" name="next" value="Next" disabled>';
        }
        echo '<input type="submit" name ="done" value="Done">';
        echo '</form>';
    }

    function updateUA($CQ)
    {
        $lastAnswer = "question{$CQ}";
        if (isset($_POST[$lastAnswer])) {
            $_SESSION['userAnswers'][$CQ] = $_POST[$lastAnswer];
        }
    }
    ?>
</body>

</html>