<?php

class Application_Resource_Avvisi extends Zend_Db_Table_Abstract
{
    protected $_name    = 'avvisi';
    protected $_primary  = 'idAvviso';
    protected $_rowClass = 'Application_Resource_Avvisi_Item';

    public function init()
    {
    }
    
    public function getAvvisi()
    {
        $select = $this->select(); 
        return $this->fetchRow($select); 
    }
}

        
