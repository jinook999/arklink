<?php

/* TEMPLATE PLUGIN OBJECT EXAMPLE */

class tpl_object_say
{

	function __construct($user='guest')
	{
		$this->user= $user;
	}
	function hello()
	{
		return 'Hello! '.$this->user;
	}
	function goodbye()
	{
		return 'Good Bye! '.$this->user;
	}
}