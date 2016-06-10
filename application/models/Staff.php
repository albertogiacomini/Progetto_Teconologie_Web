<?php

class Application_Model_Staff extends App_Model_Abstract
{ 

    public function __construct()
    {
        
    }
    
	public function getPianoByIdPlan($idplan)
    {
   	   return $this->getResource('Posizione')->getPianoByIdPlan($idplan);
	}
	
	public function getAllPosizioneByPiano($piano)
    {
		return $this->getResource('Posizione')->getAllPosizioneByPiano($piano);
	}
	
	public function getZonaByPiano($piano)
    {
    	$zone = $this->getResource('MappaEvaquazione')->getZonaByPiano($piano);
		$i=1;
		foreach ($zone as $k => $z) {
			if($z>$i)
					$i=$z;
			}
		return $i;
	}
	
	public function updatePericoloByPosizioneStaff($posizioneStaff)
    {
	return $this->getResource('Avvisi')->updatePericoloByPosizioneStaff($posizioneStaff);
	}
	
	public function insertEdificio($edificio)
    {
		return $this->getResource('Posizione')->insertEdificio($edificio);
	}
	
	public function getIdPosizioneByEdificio($Pos)
	{
		return $this->getResource('Posizione')->getIdPosizioneByEdificio($Pos);
	}
	public function getDataByIdPosizione()
	{
		return $this->getResource('Posizione')->getDataByIdPosizione();
	}
	
		public function inserisciSegnalazione($seInfo)
    {
		return $this->getResource('Avvisi')->inserisciSegnalazione($seInfo);
	}
	
	public function getPericolo($edificio)
	{
			return $this->getResource('Avvisi')->getPericolo($edificio);
	}
	
	public function getMappaEvaquazioneByEdifPiano($edificio, $piano)
    {
        return $this->getResource('MappaEvaquazione')->getMappaEvaquazioneByEdifPiano($edificio, $piano);		  
    }
	
	public function getidPosizioneByPiano($piano)
    {
		return $this->getResource('Posizione')->getidPosizioneByPiano($piano);
	}
	public function deleteAvviso($idAvviso)
	{
		return $this->getResource('Avvisi')->deleteAvviso($idAvviso);
	}
	
	public function getPosizione()
	{
		return $this->getResource('Posizione')->getPosizione();
	}
	
    public function  getUserByUName($uname)
    {
        return $this->getResource('Utente')-> getUserByUName($uname);
    }
    
    public function  getUserOrderById()
    {
        return $this->getResource('Utente')-> getUserOrderById();
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
		return $utente['posizioneStaff'];
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
        return $this->getResource('Avvisi')->getAvvisi();
    }
	
	public function getAllElAvvisi()
    {
        return $this->getResource('ElencoAvvisi')->getAllElAvvisi();
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
	public function getAvvisiByidPosizione($pos)
	{
		return $this->getResource('Avvisi')->getAvvisiByidPosizione($pos);
	}

	public function getAvvisiByDateEidPosizione($pos)
	{
		return $this->getResource('Avvisi')->getAvvisiByDateEidPosizione($pos);
	}

	public function getElAvvisoById($id)
	 {
	 		return $this->getResource('ElencoAvvisi')->getElAvvisoById($id);
	 }

	public function getElAvvisi()
    {
			return $this->getResource('ElencoAvvisi')->getElAvvisi();
	}
	
}