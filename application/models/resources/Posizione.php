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
        $select = $this->select('piano')->were('edificio = ?', $edificio);
        return $this->fetchAll($select);
    }
    
}
