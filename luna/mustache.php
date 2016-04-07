<?php

namespace Luna;

/**
 * Class CORS
 * @package Luna
 *
 * Usage:
 * 
 * $router->attach('\Luna\Mustache', '*');
 *     
 * 
 */
class Mustache extends \Zaphpa\BaseMiddleware {

  function preroute(&$req, &$res) {
    $mustache = new \Mustache_Engine(array(
        'template_class_prefix' => '__MyTemplates_',
        'cache' => __LUNA__.'/tmp/cache/mustache',
        'loader' => new \Mustache_Loader_FilesystemLoader(__LUNA__.'/views/'),
        'partials_loader' => new \Mustache_Loader_FilesystemLoader(__LUNA__.'/views/partials'),
        // 'helpers' => array('i18n' => function($text) {
        //     // do something translatey here...
        // }),
        'charset'=>"ISO-8859-1",
        'strict_callables' => true,
        'pragmas' => [\Mustache_Engine::PRAGMA_FILTERS ,\Mustache_Engine::PRAGMA_BLOCKS],
    ));

    $mustache->addHelper('date', [
        'format' => function($value) { return strtolower((string) date("d - F - Y" , $value )); },
        'form' => function($value) { return $value!=""?strtolower((string) date("Y-m-d" , $value )):""; },
        'create' => function($value) { return strtolower((string) date("l d \o\\f F " , $value )); },
        
    ]);

    $mustache->addHelper('selected',function($value){
      if($value){
        return 'checked="checked"';
      }else{
        return "";
      }
    });

    $mustache->addHelper('money',function($value){
      return number_format($value,2,".",",");
    });

     $mustache->addHelper('body',function($value){
      return nl2br( htmlentities($value) );
    });

    

    $mustache->addHelper('forma', [
        'input' => function($field) {
          $name = !isset($field["catalogo_entry_id"])?"atributo_id":"id";
          
          if( $field["atributo"]["tipo_valor"] == "img"){
            return '<div id="dropzone_complete" ></div>
          <div id="dropzone" class="dropzone" {{#imagen}}style="display:none"{{/imagen}}></div>
          <input type="hidden" name="imagen_id" id="image_uploaded" value="'.$field["valor"].'" >';

          }else if( $field["atributo"]["tipo_valor"] == "text"){
            return '<textarea name="atributo['.$field[$name].']" >'.$field["valor"].'</textarea>';
          }else{
            return '<input type="text" name="atributo['.$field[$name].']" value="'.$field["valor"].'">';
          }
        }
        
    ]);

    $res->mustache = $mustache;

    if( is_file( __LUNA__.'/views/'.implode( "/" , self::$context["callback"] ).".mustache" ) ){
      $res->m = $mustache->loadTemplate( implode( "/" , self::$context["callback"] ) ) ;    
    }

  }
  
  
  function prerender( &$buffer ) {



  }


}
