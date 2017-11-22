<?php

	//salting and hashing function
	function saltAndHash($password)
	{
		$cost = 10;
		
		//create random salt
		$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
		
		//prefix hash info
		$salt = sprintf("$2a$%02d$", $cost) . $salt;
		//hash password with salt
		$hash = crypt($password, $salt);
		return $hash;
	}
	
	$pw = "test";
	$password = saltAndHash($pw);
	echo $password;
	
?>
	
