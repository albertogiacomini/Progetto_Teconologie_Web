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
	
	public function getIdPlanimetriabyUName($username)
	{
		$pos=$this->getResource('Posizione')->getIdPosizioneByUName($username);
		return $this->getResource('Posizione')->getIdPlanimetriaByIdPosizione($pos);
	}
	
	public function getEdifici()
    {
        return $this->getResource('Posizione')->getEdifici();
    }
    
	 public function getIdPosizioneByUName($username)
    {
        return $this->getResource('Posizione')->getIdPosizioneByUName($username);
    }
	
	public function getIdPlanimetriaByIdPosizione($idposizione)
    {
        return $this->getResource('Posizione')->getIdPlanimetriaByIdPosizione($idposizione);
    }
	
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
	
	public function getPlanimetriaById($idPlanimetria)
	{
		return $this->getResource('Planimetrie')->getPlanimetriaById($idPlanimetria);
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