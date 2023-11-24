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
    <form action="buildQuiz.php" method="POST">
        <h1>Quiz App</h1>
        <h3>Select a quiz and press Start to begin:</h3>
        <select name="quizChoice">
            <option value="WorldGeography1.json">World Geography</option>
            <option value="NumberSystems.json">Number Systems</option>
        </select>
        <input type="submit" value="Start">
    </form>
</body>

</html>