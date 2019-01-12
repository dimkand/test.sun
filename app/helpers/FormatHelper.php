<?php

function asDate($date)
{
    $year = mb_substr($date, 0, 4);
    $month = mb_substr($date, 5, 2);
    $day = mb_substr($date, 8, 2);

    return $day . '.' . $month . '.' . $year;
}