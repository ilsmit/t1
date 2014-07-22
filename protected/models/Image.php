<?php
class Image extends CFormModel{
	public $path;	
    	
	public function rules(){
		return array(
				array('image', 'file', 'types'=>'jpg, gif, png'));
	}
}