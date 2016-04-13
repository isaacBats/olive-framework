<?php 


//  EJEMPLO
namespace Entity;

use Spot\EntityInterface as Entity;
use Spot\MapperInterface as Mapper;
use Spot\EventEmitter as EventEmitter;

/**
 *  Model for Countries
 * 	
 */

 class Country extends \Spot\Entity
 {

 	protected static $table = 'country';
 	
 	public static function fields(){
        return [
            'id'           => ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
            'name' => ['type' => 'string', 'required' => true],
            'zone' => ['type' => 'string', 'required' => true],
            'short_name' => ['type' => 'string', 'required' => true],
            'iso' => ['type' => 'string', 'required' => true],
            'phone_code' => ['type' => 'string'],
            'latitude' => ['type' => 'string'],
            'longitude' => ['type' => 'string'],
            'id_continent'         => ['type' => 'integer', 'required' => true],
            'date_created' => ['type' => 'datetime', 'value' => new \DateTime()]
        ];
    }

    public static function events(EventEmitter $eventEmitter)
    {
        
    }

    // public static function relations(Mapper $mapper, Entity $entity)
    // {
    //     return [
    //         'detail' => $mapper->hasOne($entity, 'Entity\UserDetails', 'user_id'),
    //     ];
    
    // }
    
 } 



 ?>