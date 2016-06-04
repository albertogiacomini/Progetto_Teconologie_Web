<?php

class Application_Resource_Planimetrie extends Zend_Db_Table_Abstract
{
    protected $_name    = 'planimetrie';
    protected $_primary  = 'idPlanimetria';
    protected $_rowClass = 'Application_Resource_Planimetrie_Item';

    public function init()
    {
    }
    
	public function getPlanimetriaById($idplan)
    {
        return $this->getAdapter()->fetchRow($this->select()->where('idPlanimetria= ?', $idplan));
    }

    
	public function getMappeById($idplan)
    {
        return $this->getAdapter()->fetchRow($this->select()->where('idPlanimetria= ?', $idplan));
    }

    public function getMappeOrderById()
    {
       $select = $this->select('mappa')->order('idplanimetria');
       return $this->fetchAll($select);
    }
}
