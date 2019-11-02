<?php


namespace App\Util;


class CSV
{
    public static function removeBOM(string $csv): string
    {
        $bom = pack('CCC', 0xef, 0xbb, 0xbf);
        if (0 === strncmp($csv, $bom, 3)) {
            $csv = substr($csv, 3);
        }
        return $csv;
    }
}
