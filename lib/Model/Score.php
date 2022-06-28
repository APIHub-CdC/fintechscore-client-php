<?php

namespace FintechScore\Client\Model;

use \ArrayAccess;
use \FintechScore\Client\ObjectSerializer;

class Score implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;
    
    protected static $FintechScoreModelName = 'Score';
    
    protected static $FintechScoreTypes = [
        'valor' => 'int',
        'razon' => '\FintechScore\Client\Model\CatalogoRazones'
    ];
    
    protected static $FintechScoreFormats = [
        'valor' => 'int32',
        'razon' => null
    ];
    
    public static function FintechScoreTypes()
    {
        return self::$FintechScoreTypes;
    }
    
    public static function FintechScoreFormats()
    {
        return self::$FintechScoreFormats;
    }
    
    protected static $attributeMap = [
        'valor' => 'valor',
        'razon' => 'razon'
    ];
    
    protected static $setters = [
        'valor' => 'setValor',
        'razon' => 'setRazon'
    ];
    
    protected static $getters = [
        'valor' => 'getValor',
        'razon' => 'getRazon'
    ];
    
    public static function attributeMap()
    {
        return self::$attributeMap;
    }
    
    public static function setters()
    {
        return self::$setters;
    }
    
    public static function getters()
    {
        return self::$getters;
    }
    
    public function getModelName()
    {
        return self::$FintechScoreModelName;
    }
    
    
    
    protected $container = [];
    
    public function __construct(array $data = null)
    {
        $this->container['valor'] = isset($data['valor']) ? $data['valor'] : null;
        $this->container['razon'] = isset($data['razon']) ? $data['razon'] : null;
    }
    
    public function listInvalidProperties()
    {
        $invalidProperties = [];
        if (!is_null($this->container['valor']) && ($this->container['valor'] > 999)) {
            $invalidProperties[] = "invalid value for 'valor', must be smaller than or equal to 999.";
        }
        if (!is_null($this->container['valor']) && ($this->container['valor'] < 0)) {
            $invalidProperties[] = "invalid value for 'valor', must be bigger than or equal to 0.";
        }
        return $invalidProperties;
    }
    
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }
    
    public function getValor()
    {
        return $this->container['valor'];
    }
    
    public function setValor($valor)
    {
        if (!is_null($valor) && ($valor > 999)) {
            throw new \InvalidArgumentException('invalid value for $valor when calling Score., must be smaller than or equal to 999.');
        }
        if (!is_null($valor) && ($valor < 0)) {
            throw new \InvalidArgumentException('invalid value for $valor when calling Score., must be bigger than or equal to 0.');
        }
        $this->container['valor'] = $valor;
        return $this;
    }
    
    public function getRazon()
    {
        return $this->container['razon'];
    }
    
    public function setRazon($razon)
    {
        $this->container['razon'] = $razon;
        return $this;
    }
    
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }
    
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }
    
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }
    
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }
    
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) {
            return json_encode(
                ObjectSerializer::sanitizeForSerialization($this),
                JSON_PRETTY_PRINT
            );
        }
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}
