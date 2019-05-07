<?php
/**
 * Created by PhpStorm.
 * User: marcmestre
 * Date: 4/04/19
 * Time: 21:12
 */

namespace App\CodeGenerator;

class MobileCodeGenerator
{
    public static function generate()
    {
        $code = random_int(100000, 999999);
        return $code;
    }
}
