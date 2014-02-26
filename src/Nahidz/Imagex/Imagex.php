<?php namespace Nahidz\Imagex;
/*
@Path: Nahid/Imagex
@Name: Imagex
@Author: Mehedi Hasan Nahid
@Download: http://github.com/nahidz/imagex
*/
class Imagex{

// setting some options	   
   protected $data=array();
   protected $image;
   protected $image_type;
   protected $suportedTypes=array(
   	'image/jpg',
   	'image/jpeg',
   	'image/pjpeg',
   	'image/gif',
   	'image/png',  
   	'image/x-png'
	);
   protected $path;
   protected $error=array();



// loading files and cheking valid format
 protected function loadImg($filename) {
 	if(in_array($_FILES[$filename]['type'], $this->suportedTypes)){
 		$filename=$_FILES[$filename]['tmp_name'];
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
         $this->image = imagecreatefrompng($filename);
      }

      return $this;
  }else{
  	$this->error[]="Sorry its not a valid Image";
  	return false;
  }
 	
   }


   //set uploading path where are files are saved

   

   // this function is saved file as image with resize and compression
   public function save() {
    	

      //$this->resize($wd, $ht);
   $image_type=$this->image_type;
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$this->data['path']."/".$this->data['name'],$this->data['compress']);
         return true;
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image,$this->data['path']."/".$this->data['name']); 
         return true;        
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image,$this->data['path']."/".$this->data['name']);
         return true;
      } 
      if( $this->data['permission'] != null) {
         chmod($filename,$this->data['permission']);
      }
   }


//basically this function is faced all data and distributed it 
   public function load($fileSource, array $options){

	   	$setOptions=array(
	   		'path'=>'',
	   		'name'=>'',
	   		'compress'=>70,
	   		'permission'=>null
	   		);
	   	foreach($setOptions as $key=>$val){
	   		if(array_key_exists($key, $options)){
	   			if(!empty($options[$key]) or is_null($options[$key])){
	   			$this->data[$key]=$options[$key];
	   			}else{
	   				$this->error[]=$key." can not be empty value";
	   			}
	   		}else{
	   			$this->data[$key]=$val;
	   		}
	   	}


	   	if(count($this->error)==0){
	   		$this->loadImg($fileSource);
	
	   		//return $this->save($this->data['name'], $this->data['compress'], $this->data['permission']);	
	   		  return $this;
        
	   		
	   	}else{
	   		return false;
	   	}


   }


//this function is called pubicly for get all errors and it returned an array
   public function getErrors(){
    return $this->error;
   }

   function output($image_type=IMAGETYPE_JPEG) {
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image);         
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image);
      }   
   }


   public function getWidth() {
      return imagesx($this->image);
   }


   public function getHeight() {
      return imagesy($this->image);
   }


   public function resizeToHeight($height) {
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
      return $this;
   }


   public function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
      return $this;
   }
   
   public function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100; 
      $this->resize($width,$height);
      return $this;
   }
   public function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;  
      return $this; 
   }      

 
  

}