<?php

namespace FintechScore\MX\Client\Model;

interface ModelInterface
{
    
    public function getModelName();
    
    public static function FintechScoreTypes();
    
    public static function FintechScoreFormats();
    
    public static function attributeMap();
    
    public static function setters();
    
    public static function getters();
    
    public function listInvalidProperties();
    
    public function valid();
}
