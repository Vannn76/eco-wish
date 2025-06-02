<?php

if (!function_exists('formatParagraphs')) {
    function formatParagraphs($text)
    {
        $paragraphs = preg_split('/\n\s*\n/', trim($text));
        $formatted = '';

        foreach ($paragraphs as $p) {
            $formatted .= '<p>' . nl2br(e(trim($p))) . '</p>';
        }

        return $formatted;
    }
}