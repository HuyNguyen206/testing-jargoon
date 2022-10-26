<?php
namespace App;

class TagParser
{
    public function parse($string)
    {
        $string = str_replace(' ', '', $string);
        $separators = [',', '|', '!'];
        $string = str_replace($separators, ',', $string);

        return explode(',', $string);
    }
}
