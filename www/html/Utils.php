<?php

namespace MyApp;

class Utils
{
    // htmlspacialcharsを究極に短く
    public static function h($value)
    {
        return htmlspecialchars($value, ENT_QUOTES);
    }
}
