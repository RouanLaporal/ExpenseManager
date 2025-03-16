<?php

namespace Domain\Entity;

use Reflection;

abstract class AbstractEntity {

    public function hydrate(array $data){
        $properties = [];
        $className = get_class($this);

        $properties[$className] = (new \ReflectionClass($this))->getProperties();
        $properties[$className] = array_map(function($property){
            return $property->getName();
        }, $properties[$className]);

        $properties[$className] = array_flip($properties[$className]);
        $array_intersect = array_intersect_key($data, $properties[$className]);
        
        foreach(array_merge($array_intersect, $data) as $property => $value){
            $method = 'set'.ucfirst($property);
            if(method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }

    public function toArray(): array{
        $properties = [];
        $className = get_class($this);
        
        $properties[$className] =  (new \ReflectionClass($this))->getProperties();
        $properties[$className] = array_map(function($property){
            return $property->getName();
        }, $properties[$className]);

        $properties[$className] = array_flip($properties[$className]);
        $data = [];
        
        foreach($properties[$className] as $property => $value){
            $method = 'get'.ucfirst($property);
            if(method_exists($this, $method)){
                $data[$property] = $this->$method();
            }
        }
        return $data;
    }

}