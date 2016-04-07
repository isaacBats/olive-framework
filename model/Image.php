<?php 


//  EJEMPLO
namespace Entity;

use Spot\EntityInterface as Entity;
use Spot\MapperInterface as Mapper;


/**
 *  Model for Faqs
 * 	
 */

 class Image extends \Spot\Entity
 {

 	protected static $table = 'image';
 	
 	public static function fields(){
        return [
            'id'           => ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
            'name'       => ['type' => 'string'],
            'path'         => ['type' => 'string', 'required' => true],
            'date_created' => ['type' => 'datetime', 'value' => new \DateTime()]
        ];
    }
    
 } 



 ?>