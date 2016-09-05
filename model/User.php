<?php 


//  EJEMPLO
namespace Entity;

use Spot\EntityInterface as Entity;
use Spot\MapperInterface as Mapper;
use Spot\EventEmitter as EventEmitter;

/**
 *  Model for Faqs
 * 	
 */

 class User extends \Spot\Entity
 {

 	protected static $table = 'user';
 	
 	public static function fields(){
        return [
            'id'           => ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
            'email'         => ['type' => 'string', 'required' => true],
            'password'         => ['type' => 'string', 'required' => true],
            'name'         => ['type' => 'string', 'required' => true],
            'type_user'         => ['type' => 'string'],
            'facebook_id'         => ['type' => 'string' ],
            'facebook_token'         => ['type' => 'string' ],
            'date_created' => ['type' => 'datetime', 'value' => new \DateTime()]
        ];
    }

    public static function events(EventEmitter $eventEmitter)
    {
        $eventEmitter->on('beforeInsert', function (Entity $entity, Mapper $mapper) {
            $entity->password = md5( $entity->password );
        });
    }
    
 } 