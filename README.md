imagex
======

Imagex is an Image handling library for Laravel 4. You can resize an image by scale, width, height and both of width and height. You can also compress image. Its too handy and easy to use.

Installation
============
add this in your main composer.json file require section
require: "nahidz/imagex": "dev-master"

and update your composer by using "composer update" command in your terminal


Configure
=========
Add these in your laravel app/config/app.php "providers" array

'Nahidz\Imagex\ImagexServiceProvider',

Usage
=====
Syntax:
Imagex::load($photoName, $optionsArray)->action($parameter)->save();

List of Action:

resizeToHeight($height)

resizeToWidth($width)

scale($scale)

resize($width, $height)

Options:
$optionsArray must be an array. Its has four items

array(
'path'=>'where you want to save your image',
'name'=>'Which name you want to set is your image',
'compress'=>'compression value 0-100, its optional',
'permission'=>'permission code, its also optional'
)


Example
=======
Imagex::load('file', array('path'=>'public/images/', 'name'=> 'my_photo.jpg'))->resizeToWidth(480)->save();


thats it.

Thank you :)



