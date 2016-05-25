<?php

class Application_Resource_Avvisi extends Zend_Db_Table_Abstract
{
    protected $_name    = 'avvisi';
    protected $_primary  = 'idAvviso';
    protected $_rowClass = 'Application_Resource_Avvisi_Item';

    public function init()
    {
    }
    
    public function getAvvisoById($A)
    {
        return $this->fetchRow($this->select()->where('idAvviso = ?', $A));
    }
}
