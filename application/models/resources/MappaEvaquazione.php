<?php

class Application_Resource_MappaEvaquazione extends Zend_Db_Table_Abstract
{
    protected $_name    = 'mappaevaquazione';
    protected $_primary  = 'idMappaEvaquazione';
    protected $_rowClass = 'Application_Resource_MappaEvaquazione_Item';

    public function init()
    {
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
}
