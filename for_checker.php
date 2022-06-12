<?php

    $file_name = 'words.txt';
    $file = fopen($file_name, 'r');
    $content = fread($file, filesize($file_name));
    fclose($file);


    $content = preg_replace('/[^a-zA-Zа-яА-ЯёЁ]/u', ' ', $content);
    $content = trim($content);

    $all_words = explode('  ', $content);

    $words = [];
    for ($i = 0, $k = 0; $i < count($all_words) / 2; $i++) {
        for ($j = 0; $j < 2; $j++) {
            if ($k === 0 || is_integer($k % 2)) {
                $words[$i][$j] = $all_words[$k];
            } else if (is_float($k % 2)){
                $words[$i][$j] = $all_words[$k];
            }
            $k++;
        }
    }

    session_unset();
    $_SESSION['true_counts'] = 0;
    $_SESSION['false_counts'] = 0;
    $clone_words = $words;

    $i = 0;
    $random_word = [];
    $array_of_answers = [];
    while(count($words) != 0) {
        $random = rand(0, count($words) - 1);
        $random_word[$i] = $words[$random][0];
        $array_of_answers[$i] = $words[$random][1];

        $_SESSION[$i . '_answer'] = $array_of_answers[$i];
        $i++;

        array_splice($words, $random, 1);
    }
        ?>

        <center>
        <div class="grid grid-cols-2 gap-4 place-content-center h-48">
        <form action="scaning.php" method="POST">
            <?php
            for($i = 0; $i <= count($clone_words) - 1; $i++) {

            echo 'Translate: ' . $random_word[$i]; ?><br>
                <label>
                    <input type="text" name="<?=$i?>_user_answer" placeholder="Введи слово" class="form-control" size="40">
                </label><br>
            <?php } ?>
            <button type="submit" class="bg-indigo-500">Готово</button>
        </form>
        </div>
        </center>