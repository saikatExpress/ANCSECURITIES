<?php

function isBangla($text) {
    $bangla_pattern = '/[\x{0980}-\x{09FF}]/u';

    $bangla_matches = preg_match_all($bangla_pattern, $text);

    $english_matches = preg_match_all('/[a-zA-Z]/', $text);

    return $bangla_matches > $english_matches;
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
