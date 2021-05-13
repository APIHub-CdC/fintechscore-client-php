<?php

namespace FintechScore\MX\Client\Model;
use \FintechScore\MX\Client\ObjectSerializer;

class CatalogoRazones
{
    
    const E0 = 'E0';
    const E1 = 'E1';
    const E2 = 'E2';
    
    
    public static function getAllowableEnumValues()
    {
        return [
            self::E0,
            self::E1,
            self::E2,
        ];
    }
}
