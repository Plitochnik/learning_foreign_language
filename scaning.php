<?php
    session_start();


    for ($i = 0; $i <= count($_SESSION) - 3; $i++) {

        $user_answer = $_REQUEST[$i.'_user_answer'];

        if (trim($user_answer) === trim($_SESSION[$i . '_answer'])) {
            $_SESSION['true_counts']++;
        } else {
            $_SESSION['false_counts']++;
        }
    }

    $_SESSION['result'] = 'Your result: ' . $_SESSION['true_counts'] . '/' . count($_SESSION) - 3;
    echo '<h1>' . $_SESSION['result'] . '</h1>';
    $_SESSION['result'] = '';
?>
    <form method="POST" action="index.php">
        <button type="submit">Go back</button>
    </form>