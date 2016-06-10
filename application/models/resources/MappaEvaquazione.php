<?php

class Application_Resource_MappaEvaquazione extends Zend_Db_Table_Abstract
{
    protected $_name    = 'mappaevaquazione';
    protected $_primary  = 'idMappaEvaquazione';
    protected $_rowClass = 'Application_Resource_MappaEvaquazione_Item';

    public function init()
    {
    }
    
	public function getZonaByPiano($piano)
    {
    	$select = $this->select()->from(array('p' => 'mappaevaquazione'),
                            	       array('p.zona'))			   
        			  		    ->where('piano = ?', $piano);
		return $this->getAdapter()->fetchAll($select);
    }
	
     public function aggiungiMappaEvaquazione($mappaInfo)
    {
       $this->insert($mappaInfo);
    }
    
    public function deleteMapEv($mapID){
        $dove="idMappaEvaquazione='". $mapID. "'";
        $this->delete($dove);
    }
    
    public function getPosizioneById($PosMap)
    {
        return $this->fetchRow($this->select()->where('idPosizioneMap = ?', $PosMap));
    }
	
	public function getMappaEvaquazioneByEdifPianoSel($edificio, $piano)
    {
        return $this->fetchRow($this->select()->where('edificio = ?', $edificio)
											  ->where('piano = ?', $piano)
											  ->where('selected = ?', '1'));
    }
	
	public function getMappaEvaquazioneByEdifPianoZona($edificio, $piano, $zona)
	{
		return $this->fetchRow($this->select()->where('edificio = ?', $edificio)
											  ->where('piano = ?', $piano)
											  ->where('zona = ?', $zona));
	}
	
	public function getMappaEvaquazioneByEdifPiano($edificio, $piano)
    {
        return $this->getAdapter()->fetchAll($this->select()->where('edificio = ?', $edificio)
											  ->where('piano = ?', $piano));				  
    }
    
    public function getMappaEvaquazioneById($idmap)
    {
        $select = $this->select()                  
                       ->where('idMappaEvaquazione= ?', $idmap);
        return $this->fetchRow($select);
    }
    
    public function getMappaEvaquazioneOrderById()
    {
       $select = $this->select()->order('idMappaEvaquazione');
       return $this->fetchAll($select);
    }
    
    public function modificaMapEv($mapInfo,$ID)
    {
        $dove="idMappaEvaquazione='". $ID ."'";
        $this->update($mapInfo,$dove);
    }
}
