<?php

class Application_Resource_ElencoAvvisi extends Zend_Db_Table_Abstract
{
    protected $_name    = 'elencoavvisi';
    protected $_primary  = 'idElencoAvviso';
    protected $_rowClass = 'Application_Resource_ElencoAvvisi_Item';

    public function init()
    {
    }
    
    public function getAvvisoById($id)
    {
        return $this->fetchRow($this->select()
                                    ->where('idElencoAvviso = ?', $id));
    }
}
