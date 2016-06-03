<?php

class Application_Resource_Planimetrie extends Zend_Db_Table_Abstract
{
    protected $_name    = 'planimetrie';
    protected $_primary  = 'idPlanimetria';
    protected $_rowClass = 'Application_Resource_Planimetrie_Item';

    public function init()
    {
    }
    
	public function getMappaById($idplan)
    {
<<<<<<< HEAD
        return $this->getAdapter()->fetchRow($this->select('mappa')->where('idPlanimetria= ?', $idplan));
=======
        return $this->getAdapter()->fetchRow($this->select()->where('idPlanimetria = ?', $idPlanimetria));
>>>>>>> 4354cc25a7d6bf5cf96fe8ef2739c52260d725c8
    }


}
