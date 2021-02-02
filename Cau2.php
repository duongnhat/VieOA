<?php

function summation1($integer1, $integer2)
{
    if ($integer1 > $integer2) {
        for ($i = 0; $i < $integer2; $i++) {
            $integer1++;
        }
        $sum = $integer1;
    } else {
        for ($i = 0; $i < $integer1; $i++) {
            $integer2++;
        }
        $sum = $integer2;
    }
    return $sum;
}

function summation2($integer1, $integer2)
{
    $integer1 += $integer2;
    return $integer1;
}
