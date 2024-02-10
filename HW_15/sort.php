<?php

function quicksort($array) {
    if(count($array) < 2) {
        return $array;
    } else {
        $pivot = $array[0];
        $less = [];
        $greater = [];
        for($i=1; $i<count($array); $i++) {
            if($array[$i] <= $pivot) {
                array_push($less, $array[$i]);
            }
            if($array[$i] > $pivot) {
                array_push($greater, $array[$i]);
            }
        }
        return array_merge(quicksort($less), array($pivot), quicksort($greater));
    }
}

function findminnumber($array) {
    $n = $array[0];
    for($i=0; $i<count($array)-1; $i++) {
        if ($n > $array[$i]) {
            $n = $array[$i];
        }
    }
    return $n;

}

// Example usage:
$unsortedArray = [5, 2, 9, 1, -7, 8, 4, 11, 235, 7];
print_r($unsortedArray);
$sortedArray = quickSort($unsortedArray);
print_r($sortedArray);
$minnumber = findminnumber($unsortedArray);
print_r($minnumber);