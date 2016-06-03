<?php

class Application_Resource_Posizione extends Zend_Db_Table_Abstract
{
    protected $_name    = 'posizione';
    protected $_primary  = 'idPosizione';
    protected $_rowClass = 'Application_Resource_Posizione_Item';

    public function init()
    {}
    
    public function getEdifici()
    {
        $select = $this->select()
                       ->from(array('p' => 'posizione'),
                              array('p.edificio'))->distinct();
                              
        return $this->fetchAll($select);
    }
    
    public function getPianoByEdificio($edificio)
    {
        $select = $this->select('piano')->where('edificio = ?', $edificio);
        return $this->getAdapter()->fetchAll($select);
    }
    
	public function getIdPlanimetriaByEdificioPiano($edificio, $piano)
    {
        return $this->getAdapter()->fetchRow($this->select('idPlanimetria')->where('edificio = ?', $edificio)
        									  				->where('piano = ?', $piano));
    }
	
	public function getIdPlanimetriaByIdPosizione($idposizione)
	{
		return $this->getAdapter()->fetchRow($this->select('idPlanimetria')->where('idPosizione = ?', $idposizione));
	}
	
	public function getIdPosizioneByUName($username)
	{
		return $this->getAdapter()->fetchRow($this->select('idPosizione')->where('username= ?', $username));  									  				
	}
}
