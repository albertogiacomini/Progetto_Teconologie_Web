<?php

class Application_Model_User extends App_Model_Abstract
{ 

    public function __construct()
    {
        
    }
	
	public function insertUser($usrInfo)
    {
        return $this->getResource('Utente')->insertUser($usrInfo);
    }
	
	
}