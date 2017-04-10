<?php

class AddCategory{

public static function saveCat($value)
{
	# code...
		$user_id = Auth::user()->id;
		$arraylist = $value;
		$comma_separated = implode(",", $arraylist);

		$catlist = explode(",", $comma_separated);

		$category = new Catinput;

		foreach ($catlist as $key) {
		$category->user_id = $user_id;
		$category->cat_id = $key;
		$category->save();			
		}
}

}