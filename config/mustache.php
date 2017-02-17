<?php

namespace config;

/**
 * Class CORS
 * @package config
 *
 * Usage:
 * 
 * $router->attach('\Luna\Mustache', '*');
 *     
 * 
 */
// class Mustache extends \Zaphpa\BaseMiddleware {

//   function preroute(&$req, &$res) {
//     $mustache = new \Mustache_Engine(array(
//         'template_class_prefix' => '__MyTemplates_',
//         'cache' => __OLIVE__.'/tmp/cache/mustache',
//         'loader' => new \Mustache_Loader_FilesystemLoader(__OLIVE__.'/views/'),
//         'partials_loader' => new \Mustache_Loader_FilesystemLoader(__OLIVE__.'/views/partials'),
//         // 'helpers' => array('i18n' => function($text) {
//         //     // do something translatey here...
//         // }),
//         'charset'=>"UTF-8",
//         'strict_callables' => true,
//         'pragmas' => [\Mustache_Engine::PRAGMA_FILTERS ,\Mustache_Engine::PRAGMA_BLOCKS],
//     ));

//     $mustache->addHelper('date', [
//         'format' => function($value) { return strtolower((string) date("d - F - Y" , $value )); },
//         'form' => function($value) { return $value!=""?strtolower((string) date("Y-m-d" , $value )):""; },
//         'create' => function($value) { return strtolower((string) date("l d \o\\f F " , $value )); },
//         'corto' => function($value) {
//                 if ($value != null) {
//                     $m = date("m", $value);
// //                    $m = \Util::Mes($m);
//                     $f = ((string) date("j/m/Y", $value));
//                     return $f;
//                 }
//                 return '';
//             },
//             'fecha_hora' => function($value) {
//                 if ($value != null) {
//                     $m = date("m", $value) - 1;
//                     $m = \Util::Mes($m);
//                     $f = $m . ' ' . ((string) date("j, Y, g:i a", $value));
//                     return $f;
//                 }
//                 return '';
//             },
//             'fecha_hora_digitos' => function($value) {
//                 if ($value != null) {
//                     $f = ((string) date("j/m/Y H:i:s", $value));
//                     return $f;
//                 }
//                 return '';
//             },        
//     ]);

//     $mustache->addHelper('selected',function($value){
//       if($value){
//         return 'checked="checked"';
//       }else{
//         return "";
//       }
//     });

//     $mustache->addHelper('money',function($value){
//       return number_format($value,2,".",",");
//     });

//      $mustache->addHelper('body',function($value){
//       return nl2br( htmlentities($value) );
//     });

    

//     $mustache->addHelper('forma', [
//         'input' => function($field) {
//           $name = !isset($field["catalogo_entry_id"])?"atributo_id":"id";
          
//           if( $field["atributo"]["tipo_valor"] == "img"){
//             return '<div id="dropzone_complete" ></div>
//           <div id="dropzone" class="dropzone" {{#imagen}}style="display:none"{{/imagen}}></div>
//           <input type="hidden" name="imagen_id" id="image_uploaded" value="'.$field["valor"].'" >';

//           }else if( $field["atributo"]["tipo_valor"] == "text"){
//             return '<textarea name="atributo['.$field[$name].']" >'.$field["valor"].'</textarea>';
//           }else{
//             return '<input type="text" name="atributo['.$field[$name].']" value="'.$field["valor"].'">';
//           }
//         }
        
//     ]);

//     $res->mustache = $mustache;

//     if( is_file( __OLIVE__.'/views/'.implode( "/" , self::$context["callback"] ).".mustache" ) ){
//       $res->m = $mustache->loadTemplate( implode( "/" , self::$context["callback"] ) ) ;    
//     }

//   }
  
  
//   function prerender( &$buffer ) {



//   }


// }
