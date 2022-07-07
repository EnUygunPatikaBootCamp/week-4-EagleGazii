<?php

/**
 * Read json file from public/jokes.json and decode them.
 * @return mixed
 */
function getData() {
    $string = file_get_contents("C:\Users\Gazmor\Desktop\PHP Enuygun\Week 4\web_app\public\jokes.json");
    return json_decode($string, true);
}

/**
 * Get random jokes from jokes.json file.
 * @param int $numOfJokes
 * @return array
 */
function getRandomJokes(int $numOfJokes):array{
    $array = getData();
    $randomArray = [];

    for($i=0;$i<$numOfJokes;$i++){
        $randomIndex = rand(0,count($array)-1);
        $randomArray[] = $array[$randomIndex];
    }
    return $randomArray;
}

