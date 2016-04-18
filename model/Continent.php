<?php 


//  EJEMPLO
namespace Entity;

use Spot\EntityInterface as Entity;
use Spot\MapperInterface as Mapper;
use Spot\EventEmitter as EventEmitter;

/**
 *  Model for Continents
 * 	
 */

 class Continent extends \Spot\Entity
 {

 	protected static $table = 'continent';
 	
 	public static function fields(){
        return [
            'id' => ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
            'name' => ['type' => 'string', 'required' => true],
            'date_created' => ['type' => 'datetime', 'value' => new \DateTime()]
        ];
    }

    public static function events(EventEmitter $eventEmitter)
    {
        
    }

    public static function relations(Mapper $mapper, Entity $entity)
    {
        return [
            'detail' => $mapper->hasMany($entity, 'Entity\Country', 'id_continent'),
        ];
    
    }
    
 } 



 ?>