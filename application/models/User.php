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
    
    public function deleteUser($username)
    {
        return $this->getResource('Utente')->deleteUser($username);
    }
    
    public function updateUser($usrI,$un)
    {
        return $this->getResource('Utente')->updateUser($usrI,$un);
    }
    
    public function  getUserByUName($uname)
    {
        return $this->getResource('Utente')-> getUserByUName($uname);
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
	
	public function getIdPlanimetriaByEdificioPiano($edificio, $piano)
	{
		return $this->getResource('Posizione')->getIdPlanimetriaByEdificioPiano($edificio, $piano);
	}
	
	public function getPlanimetriaById($idPlanimetria)
	{
		return $this->getResource('Planimetrie')->getPlanimetriaById($idPlanimetria);
	}
	
	public function setAulaByIdPos($idPos, $aula)
	{
		return $this->getResource('Posizione')->setAulaByIdPos($idPos, $aula);
	}
	
	public function getIdPosizioneByUName($user)
	{
		return $this->getResource('Utente')->getIdPosizioneByUName($user);
	}
	
	public function setIdPosByUName($idPos, $uName)
	{
		return $this->getResource('Utente')->setIdPosByUName($idPos, $uName);
	}
	
	public function getIdPosizioneByEdPi($ed, $pi)
	{
		return $this->getResource('Posizione')->getIdPosizioneByEdPi($ed, $pi);
	}
}