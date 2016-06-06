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
    	        $select = $this->select('mappa')	
								->from(array('p' => 'planimetrie'),
                            	       array('p.idPlanimetria'))->distinct()				   
        			  		    ->where('idPlanimetria= ?', $idplan)->distinct();
		
        return $this->getAdapter()->fetchRow($select);
    }
    
	public function getPlanimetrieById($idplan)
    {
        return $this->getAdapter()->fetchRow($this->select('mappa')->where('idPlanimetria= ?', $idplan));
    }

    public function getPlanimetrieOrderById()
    {
       $select = $this->select()->order('idPlanimetria');
       return $this->fetchAll($select);
    }
}
