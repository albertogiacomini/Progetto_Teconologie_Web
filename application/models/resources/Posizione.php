<?php

class Application_Resource_Posizione extends Zend_Db_Table_Abstract
{
    protected $_name    = 'posizione';
    protected $_primary  = 'idPosizione';
    protected $_rowClass = 'Application_Resource_Posizione_Item';

    public function init()
    {
    }
    
    public function getPosizioneById($Pos)
    {
        return $this->fetchRow($this->select()->where('idPosizione = ?', $Pos));
    }
}
