<?php namespace Nahidz\Imagex\Facades;

use Illuminate\Support\Facades\Facade;

class Imagex extends Facade{
	protected static function getFacadeAccessor(){
		return "imagex";
	}
}