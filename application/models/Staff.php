<?php

class Application_Model_Staff extends App_Model_Abstract
{ 

    public function __construct()
    {
        
    }
	
    public function  getUserByUName($uname)
    {
        return $this->getResource('Utente')-> getUserByUName($uname);
    }	
	
	public function  getPianoByComp($uname)
    {
        return $this->getResource('Posizione')-> getPianoByComp($uname);
    }	
	
	public function getEdifici()
    {
        return $this->getResource('Posizione')->getEdifici();
    }
	
	public function getIdPlanimetriaByPosizionestaff($Pos)
	{
		return $this->getResource('Posizione')->getIdPlanimetriaByPosizionestaff($Pos);
	}
	
    //Metodi Staff per prendere mappa associate ad esso
 	public function getMappaById($idPlanimetria)
	{
		return $this->getResource('Planimetrie')->getMappaById($idPlanimetria);
	}   
	
	public function getIdPlanimetriaByIdPosizione($idposizione)
    {
        return $this->getResource('Posizione')->getIdPlanimetriaByIdPosizione($idposizione);
    }
	
	public function getIdPosizioneByPosizionestaff($idposizione)
    {
        return $this->getResource('Posizione')->getIdPosizioneByPosizionestaff($idposizione);
    }
	
	public function getAvvisiByPosizionestaff($pos)
	{
		return $this->getResource('Avvisi')->getAvvisiByPosizionestaff($pos);
	}
	
	public function getIdPosizioneByIdPlanimetria($idPlan)
	{
		return $this->getResource('Posizione')->getIdPosizioneByIdPlanimetria($idPlan);
	}
	
	public function getUtenteByUName($username)
    {
        return $this->getResource('Utente')->getUtenteByUName($username);
    }
	
	public function getPosizionestaffByUName($username)
	{	
		$utente = $this->getResource('Utente')->getPosizionestaffByUName($username);
		return $utente['PosizioneStaff'];
	}
	
	//Staff
	public function getPlanimetriaById($idPlanimetria)
	{
		return $this->getResource('Planimetrie')->getPlanimetriaById($idPlanimetria);
	}
	
	public function getPlanimetrieOrderById($idPlanimetria)
	{
		return $this->getResource('Planimetrie')->getPlanimetrieOrderById($idPlanimetria);
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
	//metodi per segnalazioni sui piani
	public function getAvvisiByIdPosizione($pos)
	{
		return $this->getResource('Avvisi')->getAvvisiByIdPosizione($pos);
	}

	public function getIdPosizioneByPiano($piano)
	{
		return $this->getResource('Posizione')->getIdPosizioneByPiano($piano);
	}

}