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
	
	public function getIdPlanimetriaByIdPosizione($idpos)
	{
		return $this->getAdapter()->fetchRow($this->select('idPlanimetria')->where('idPosizione = ?', $idpos));
	}
	
	public function getIdPosizioneByEdPi($ed, $pi)
	{
		return $this->getAdapter()->fetchRow($this->select('idPosizione')->where('edificio = ?', $ed)
																		 ->where('piano = ?', $pi));
	}
	
	public function setAulaByIdPos($idPos, $aula)
	{
		
		$db = new Zend_Db_Adapter_Pdo_Mysql(array(
												    'host'     => 'localhost',
												    'username' => 'root',
												    'password' => 'root',
												    'dbname'   => 'grp_04_db'
												));
		$data      = array('aula' => $aula); 
		$where[] = $db->quoteInto('idPosizione = ?', $idPos); 
		$db->update($this->_name, $data, $where); 
	}
	
	
}
