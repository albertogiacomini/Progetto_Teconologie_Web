<?php

class Application_Model_User extends App_Model_Abstract
{
        
    public function __construct()
    {
       
    }
	
	//AVVISI
	public function getAvvisi()
    {
         return $this->getResource('Avvisi')->getAvvisi();
    }
    
    public function getAvvisiByDate()
    {
         return $this->getResource('Avvisi')->getAvvisiByDate();
    }
    
    public function getAvvisoById($id)
    {
        return $this->getResource('ElencoAvvisi')->getElAvvisoById($id);
    }

	public function inserisciSegnalazione($seInfo)
	{
		return $this->getResource('Avvisi')->inserisciSegnalazione($seInfo);		
	}
	
	public function getAvvisoByIdUtente($IdUtente, $MM, $yyyy, $dd, $HH)
	{
		$data = $this->getResource('Avvisi')->getAvvisoByIdUtente($IdUtente, $MM, $yyyy, $dd);
		$c = count($data);
		if($c != 0){
			foreach ($data as $d){
			$dateString = Zend_Locale_Format::getDate($d['data'],
											array('date_format' => 'YYYY-MM-dd HH:mm:ss'));		
				$h = $dateString['hour'];
				if(($HH-$h)<4){
					return false;
				}
			}
		}
		return true;
	}
	
	//CATEGORIE
	
	//ELENCO AVVISI
	public function getElAvvisi()
	{
		return $this->getResource('ElencoAvvisi')->getElAvvisi();
	}	
    
    public function getAllElAvvisi()
    {
        return $this->getResource('ElencoAvvisi')->getAllElAvvisi();
    }   
	
	public function getIdElAvvisoByTipo($TAvviso)
	{
		return $this->getResource('ElencoAvvisi')->getIdElAvvisoByTipo($TAvviso);
	}
	
	//FAQ
	
	//MAPPA EVAQUAZIONE
	public function getMappaEvaquazioneByEdifPianoSel($edificio, $piano)
	{
		return $this->getResource('MappaEvaquazione')->getMappaEvaquazioneByEdifPianoSel($edificio, $piano);
	}
	
	//PLANIMETRIE
	public function getPlanimetriaById($idPlanimetria)
	{
		return $this->getResource('Planimetrie')->getPlanimetriaById($idPlanimetria);
	}
	
	//POSIZIONE
	public function getEdifici()
    {
        return $this->getResource('Posizione')->getEdifici();
    }
    
    public function getPianoByEdificio($edif)
    {
        return $this->getResource('Posizione')->getPianoByEdificio($edif);
    }
	
	public function getIdPlanimetriaByEdificioPiano($edificio, $piano)
	{
		return $this->getResource('Posizione')->getIdPlanimetriaByEdificioPiano($edificio, $piano);
	}
	
	public function getIdPosizioneByEdPiAl($ed, $pi, $al)
	{
		return $this->getResource('Posizione')->getIdPosizioneByEdPiAl($ed, $pi, $al);
	}
	
	public function getDataByIdPosizione($idPos)
	{
		return $this->getResource('Posizione')->getDataByIdPosizione($idPos);
	}
	
	//UTENTE
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
    
    public function updateUserById($usrI,$ID)
    {
        return $this->getResource('Utente')->updateUserByID($usrI,$ID);
    }
    
    public function  getUserByUName($uname)
    {
        return $this->getResource('Utente')-> getUserByUName($uname);
    }
	
	public function  getUserOrderById()
    {
        return $this->getResource('Utente')->getUserOrderById();
    }
	
	public function setIdPosByUName($idPos, $uName)
	{
		return $this->getResource('Utente')->setIdPosByUName($idPos, $uName);
	}
}