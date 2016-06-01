<?php

class Application_Model_Staff extends App_Model_Abstract
{ 

    public function __construct()
    {
        
    }
	
	    public function getUserByUName($info)
    {
        return $this->getResource('Utente')->getUserByUName($info);
    }
	
	public function getEdifici()
    {
        return $this->getResource('Posizione')->getEdifici();
    }
    
    public function getPianoByEdificio($edif)
    {
        return $this->getResource('Posizione')->getPianoByEdificio($edif);
    }
}