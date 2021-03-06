<?php

class Application_Resource_ElencoAvvisi extends Zend_Db_Table_Abstract
{
    protected $_name    = 'elencoavvisi';
    protected $_primary  = 'idElencoAvviso';
    protected $_rowClass = 'Application_Resource_ElencoAvvisi_Item';

    public function init()
    {
    }
    
    public function getElAvvisi()
    {
    	$select = $this->select()
                       ->from($this->_name,
                              array('value'=>'tipoAvviso'));
        return $this->getAdapter()->fetchAll($select);
    }
	
    public function getElAvvisoById($id)

    {
        return $this->getAdapter()->fetchRow($this->select()->where('idElencoAvviso = ?', $id));
    }
    
    public function getAllElAvvisi()

    {
        return $this->fetchAll($this->select());
    }
	
	public function getIdElAvvisoByTipo($TAvviso)
    {
        return $this->getAdapter()->fetchRow($this->select()->where('tipoAvviso = ?', $TAvviso));
    }
    
}