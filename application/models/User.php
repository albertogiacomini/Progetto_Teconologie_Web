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
    
    public function getEdifici()
    {
        return $this->getResource('Posizione')->getEdifici();
    }
    
    public function getPianoByEdificio($edif)
    {
        return $this->getResource('Posizione')->getPianoByEdificio($edif);
    }
    
	public function getAvvisi()
    {
        return $this->getResource('Avvisi')->getAvvisi();
    }
	
}