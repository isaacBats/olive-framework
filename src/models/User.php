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

 	protected static $table = 'users';
 	
 	public static function fields(){
        return [
            'id'           => ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
            'email'        => ['type' => 'string', 'required' => true, 'unique' => true],
            'password'     => ['type' => 'string', 'required' => true],
            'user_name'    => ['type' => 'string', 'unique' => true],
            'type_user'    => ['type' => 'smallint'],
            'is_active'    => ['type' => 'smallint'],
            'date_created' => ['type' => 'datetime', 'value' => new \DateTime()]
        ];
    }

    public static function events(EventEmitter $eventEmitter)
    {
        $eventEmitter->on('beforeInsert', function (Entity $entity, Mapper $mapper) {
            $entity->password = md5( $entity->password );
        });

        $eventEmitter->on('beforeUpdate', function (Entity $entity, Mapper $mapper) {
            $current_passr = $mapper->first(['id' => $entity->toArray()['id']])->toArray()['password'];
            if ($entity->password != $current_passr) {
                $entity->password = md5($entity->password);
            }
        });
    }
    
 } 