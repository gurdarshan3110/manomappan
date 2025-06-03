<?php

if (!function_exists('get_initials')) {
    function get_initials(string $name): string 
    {
        $initials = '';
        if (strpos($name, ' ') !== false) {
            $parts = explode(' ', $name);
            foreach ($parts as $part) {
                if (!empty($part)) {
                    $initials .= strtoupper(mb_substr($part, 0, 1));
                }
            }
        } else {
            $initials = strtoupper(mb_substr($name, 0, 2));
        }
        return $initials;
    }
}
