<?php

function specialPush1(&$stackS, $element)
{
    $tmp = new Stack();

    $check = $stackS->pop();
    while ($element > $check) {
        $tmp->push($check);
        $check = $stackS->pop();
    }

    $stackS->push($check);
    $stackS->push($element);

    $tmpValue = $tmp->pop();
    while ($tmpValue != null) {
        $stackS->push($tmpValue);
        $tmpValue = $tmp->pop();
    }
}

function specialPush2(&$stackS, $element)
{
    $tmp = array();

    array_push($tmp, $element);

    $element = $stackS->pop();
    while ($element != null) {
        array_push($tmp, $element);
        $element = $stackS->pop();
    }

    rsort($tmp);
    foreach ($tmp as $value) {
        $stackS->push($value);
    }
}
