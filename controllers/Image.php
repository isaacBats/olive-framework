<?php 

/**
*	Controlador de Imagenes
*
* 
*/

class Image extends Luna\Controller
{
	
	

	public function upload( $req , $res ){
		//  Example 
		// $forms = [ "register.gallery" => [
		// 				"validate" => function( $_self ){return $_self->session->get("place" , false );},
		// 				"onComplete" => function( $_self ,  \Entity\Image $image ){
		// 					$PIMapper = $_self->spot->mapper("Entity\PlaceImage");
		// 					$place = $_self->session->get("place", false);
		// 					if( $place ){
		// 						$PIMapper->create([
		// 							'place_id'   => $place["id"],
		// 				            'image_id'   => $image->id,
		// 							]);
		// 						return true;
		// 					}else{
		// 						return false;
		// 					}
							
		// 				}]
		// 			  ];

		if( isset( $req->data["form"] ) ){
			
			if( isset( $forms[$req->data["form"]]) ){
				if( $forms[$req->data["form"]]["validate"]( $this ) ){

					$fileDir = __ASSETS__."files/";
					// CHECK DIRECTORIES
					if( !is_dir($fileDir) ){mkdir( $fileDir );}
					$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
					$name = md5($_FILES['file']['name']).".jpg";

					if (!empty($_FILES)) {
					    $tempFile = $_FILES['file']['tmp_name'];
					    $targetFile =  $fileDir.$name;

					    global $imageMannager;

					    $img = $imageMannager->make($tempFile);
					    
					    $img->widen(2120, function ($constraint) {
						    $constraint->upsize();
						});
						$img->backup();
						$img->save($targetFile , 80 );

					    if( !is_dir($fileDir."small/") ){mkdir( $fileDir."small/" );}
						$img->resize(300, null, function ($constraint) {
						    $constraint->aspectRatio();
						    $constraint->upsize();
						});
						$img->save($fileDir."small/".$name , 60 );

						$img->reset();

						if( !is_dir($fileDir."medium/") ){mkdir( $fileDir."medium/" );}
						$img->resize(600, null, function ($constraint) {
						    $constraint->aspectRatio();
						    $constraint->upsize();
						});
						$img->save($fileDir."medium/".$name , 60 );

						$img->reset();

						if( !is_dir($fileDir."large/") ){mkdir( $fileDir."large/" );}
						$img->resize(1200, null, function ($constraint) {
						    $constraint->aspectRatio();
						    $constraint->upsize();
						});
						$img->save($fileDir."large/".$name , 80 );
					}

					$image = $this->mapper->build([
								'nombre' => $_FILES['file']['name'],
								'path' => $name
					]);

					$this->mapper->save($image);

					if( isset( $forms[$req->data["form"]]["onComplete"] ) ){
						$forms[$req->data["form"]]["onComplete"]( $this , $image );
					}

					$res->addHeader( "Content-Type ", "application/json; charset=utf-8");
					$res->add(json_encode( $image  , JSON_UNESCAPED_UNICODE) );
					echo $res->send(); 	

				}else{
					echo " NOT MEET THE CRIATERIA FOR UPLOAD ";
					exit;	
				}
			}else{
				echo " NOT A VALID FORM";
				exit;
			}

		}
		
	}

}
