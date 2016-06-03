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
	
	/*public function getIdMappabyUName($username)
	{
		$pos=$this->getResource('Utente')->getIdPosizioneByUName($username);
		$plan=$this->getResource('Posizione')->getIdPlanimetriaByIdPosizione($pos);
		return 	$this->getResource('Planimetrie')->getMappaById($plan);
	}*/
	
	public function getEdifici()
    {
        return $this->getResource('Posizione')->getEdifici();
    }
    //Staff
 	public function getMappaById($idPlanimetria)
	{
		return $this->getResource('Planimetrie')->getMappaById($idPlanimetria);
	}   
	
	public function getIdPlanimetriaByIdPosizione($idposizione)
    {
        return $this->getResource('Posizione')->getIdPlanimetriaByIdPosizione($idposizione);
    }
	
	public function getIdPosizioneByUName($username)
    {
        return $this->getResource('Utente')->getIdPosizioneByUName($username);
    }
	
	
	

	//Staff
    public function getPianoByEdificio($edif)
    {
        return $this->getResource('Posizione')->getPianoByEdificio($edif);
    }
	
	public function getAvvisi()
    {
        return $this->getResource('Avvisi')->getSegnalazioni();
    }
	
	public function getIdPlanimetriaByEdificioPiano($edificio, $piano)
	{
		return $this->getResource('Posizione')->getIdPlanimetriaByEdificioPiano($edificio, $piano);
	}
	
	public function insertUser($usrInfo)
    {
        return $this->getResource('Utente')->insertUser($usrInfo);
    }
    
    public function deleteUser($username)
    {
        return $this->getResource('Utente')->deleteUser($username);
    }
    
    public function updateUser($usrI,$un)
    {
        return $this->getResource('Utente')->updateUser($usrI,$un);
    }
}