<?php

class Application_Resource_ElencoAvvisi extends Zend_Db_Table_Abstract
{
    protected $_name    = 'elencoAvvisi';
    protected $_primary  = 'idAvviso';
    protected $_rowClass = 'Application_Resource_ElencoAvvisi_Item';

    public function init()
    {
    }
    
    public function getElAvvisoById($Avviso)
    {
        return $this->fetchRow($this->select()->where('idAvviso = ?', $Avviso));
    }
}
