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
        $select = $this->select('piano')	
								->from(array('p' => 'posizione'),
                            	       array('p.edificio'))->distinct()				   
        			  		    ->where('edificio = ?', $edificio)->distinct();
		
        return $this->getAdapter()->fetchRow($select);
    }
	
	public function getPianoByComp($edificio)
    {
 
  	    return $this->getAdapter()->fetchRow($this->select()->distinct()->where('edificio = ?', $edificio));
    }
        									  				
    
    
	public function getIdPlanimetriaByEdificioPiano($edificio, $piano)
    {
        return $this->getAdapter()->fetchRow($this->select('idPlanimetria')->where('edificio = ?', $edificio)
        									  				->where('piano = ?', $piano));
    }
	
	public function getIdPlanimetriaByIdPosizione($idPos)
	{
		return $this->getAdapter()->fetchRow($this->select('idPlanimetria')->where('idPosizione = ?', $idPos));
	}
	
	public function getIdPosizioneByEdPiAl($ed, $pi, $al)
	{
		return $this->getAdapter()->fetchRow($this->select('idPosizione')->where('edificio = ?', $ed)
																		 ->where('piano = ?', $pi)
																		 ->where('aula = ?', $al));
	}
	
	public function getDataByIdPosizione($idPos)
	{
		return $this->getAdapter()->fetchRow($this->select()->where('idPosizione = ?', $idPos));
	}
	
	
}
