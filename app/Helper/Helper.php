<?php

function isBangla($text) {
    $bangla_pattern = '/[\x{0980}-\x{09FF}]/u';

    $bangla_matches = preg_match_all($bangla_pattern, $text);

    $english_matches = preg_match_all('/[a-zA-Z]/', $text);

    return $bangla_matches > $english_matches;
}


function formatDateTime($datetime) {
    // Convert the string to a DateTime object
    $date = new DateTime($datetime);

    // Format the date and time
    return $date->format('m/d/y');
}

function numberToWords($number) {
    $hyphen = '-';
    $conjunction = ' and ';
    $separator = ', ';
    $negative = 'negative ';
    $decimal = ' point ';
    $dictionary = array(
        0    => 'zero',     1       => 'one',     2          => 'two',       3             => 'three',    4  => 'four',
        5    => 'five',     6       => 'six',     7          => 'seven',     8             => 'eight',    9  => 'nine',
        10   => 'ten',      11      => 'eleven',  12         => 'twelve',    13            => 'thirteen', 14 => 'fourteen',
        15   => 'fifteen',  16      => 'sixteen', 17         => 'seventeen', 18            => 'eighteen', 19 => 'nineteen',
        20   => 'twenty',   30      => 'thirty',  40         => 'forty',     50            => 'fifty',    60 => 'sixty',
        70   => 'seventy',  80      => 'eighty',  90         => 'ninety',    100           => 'hundred',
        1000 => 'thousand', 1000000 => 'million', 1000000000 => 'billion',   1000000000000 => 'trillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if ($number < 0) {
        return $negative . numberToWords(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens = intval($number / 10) * 10;
            $units = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds = intval($number / 100);
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . numberToWords($remainder);
            }
            break;
        case $number < 1000000:
            $thousands = intval($number / 1000);
            $remainder = $number % 1000;
            $string = numberToWords($thousands) . ' ' . $dictionary[1000];
            if ($remainder) {
                $string .= $separator . numberToWords($remainder);
            }
            break;
        case $number < 1000000000:
            $millions = intval($number / 1000000);
            $remainder = $number % 1000000;
            $string = numberToWords($millions) . ' ' . $dictionary[1000000];
            if ($remainder) {
                $string .= $separator . numberToWords($remainder);
            }
            break;
        case $number < 1000000000000:
            $billions = intval($number / 1000000000);
            $remainder = $number % 1000000000;
            $string = numberToWords($billions) . ' ' . $dictionary[1000000000];
            if ($remainder) {
                $string .= $separator . numberToWords($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split($fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}



function formatTimeWithAmPm($time) {
    return date('h:i A', strtotime($time));
}

function truncate_text($text, $limit, $isBangla) {
    if ($isBangla) {
        if (mb_strlen($text, 'UTF-8') <= $limit) {
            return $text;
        }

        $words = preg_split('/\s+/u', $text);
        $truncated = '';
        $total_length = 0;

        foreach ($words as $word) {
            $total_length += mb_strlen($word, 'UTF-8') + 1;
            if ($total_length > $limit) {
                break;
            }
            $truncated .= $word . ' ';
        }

        return trim($truncated) . ' ...';
    } else {
        return implode(' ', array_slice(str_word_count($text, 1), 0, $limit)) . ' ...';
    }
}
