<?php

class Application_Resource_MappaEvaquazione extends Zend_Db_Table_Abstract
{
    protected $_name    = 'mappaEvaquazione';
    protected $_primary  = 'idPosizioneMap';
    protected $_rowClass = 'Application_Resource_MappaEvaquazione_Item';

    public function init()
    {
    }
    
    public function getPosizioneById($PosMap)
    {
        return $this->fetchRow($this->select()->where('idPosizioneMap = ?', $PosMap));
    }
}
