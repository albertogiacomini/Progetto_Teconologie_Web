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

    	$select = $this->select()				   
        			   ->where('idPlanimetria= ?', $idplan);
        return $this->fetchRow($select);
	}

    public function getPlanimetrieOrderById()
    {
       $select = $this->select()->order('idPlanimetria');
       return $this->fetchAll($select);
    }
    
    public function getMaxIdPlan(){
                $select = $this->select()
            ->from(array('t' => 'planimetrie'),array(new Zend_Db_Expr('MAX(idPlanimetria) as maxid')));
        $row = $this->fetchRow($select);
        if(!$row){
            return false;
        }else{
            $tData = $row->toArray();
            return $tData ['maxid'];
        }
        }
    
    public function aggiungiPlanimetria($planInfo)
    {
       $this->insert($planInfo);
    }
    
    public function deletePlan($planID)
    {
        $dove="idPlanimetria='". $planID. "'";
        $this->delete($dove);
    }
    
      public function modificaPlanimetria($planInfo,$ID)
    {
        $dove="idPlanimetria='". $ID. "'";
        $this->update($planInfo,$dove);
    }
    
}
