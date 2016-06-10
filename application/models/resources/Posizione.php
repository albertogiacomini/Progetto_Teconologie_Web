<?php

class Application_Resource_Posizione extends Zend_Db_Table_Abstract
{
    protected $_name    = 'posizione';
    protected $_primary  = 'idPosizione';
    protected $_rowClass = 'Application_Resource_Posizione_Item';

    public function init()
    {}
    
    public function aggiungiPosizione($posInfo)
    {
       $this->insert($posInfo);
    }
    
    public function getPosizione()
    {
        $select = $this->select(); 
        return $this->fetchAll($select); 
    }
    

	public function getAllPosizioneByPiano($piano)
    {
		return $this->getAdapter()->fetchAll($this->select()->where('edificio = ?', $piano));
    }
	
	public function insertEdificio($edificio)
    {
        $this->insert($edificio);
    }
	
     public function getPosizioneByIdPlanimetria($idplan)
    {
        $select = $this->select()->where('idPlanimetria = ?', $idplan); 
        return $this->fetchRow($select);
    }
	
    public function getEdifici()
    {
        $select = $this->select()
                       ->from($this->_name,
                              array('value'=>'edificio'))->distinct();
        return $this->getAdapter()->fetchAll($select);
    }
    
    public function getPianoByEdificio($edificio)
    {
        $select = $this->select()->from(array('p' => 'posizione'),
                            	       array('p.piano'))->distinct()				   
        			  		    ->where('edificio = ?', $edificio);
		
        return $this->getAdapter()->fetchAll($select);
    }
	
	public function getIdPosizioneByPiano($piano)
    {
        $select = $this->select()->from(array('p' => 'posizione'),
                            	       array('p.idPosizione'))				   
        			  		     ->where('piano = ?', $piano);
        return $this->fetchAll($select);
    }
    
    public function getPianoByIdPosizione($IdPos)
    {
        $select = $this->select()->from(array('p' => 'posizione'),
                                       array('p.piano'))                 
                                 ->where('idPosizione = ?', $IdPos);
        return $this->fetchRow($select);
    }
	
	public function getPianoByIdPlan($idplan)
    {
        $select = $this->select()->from(array('p' => 'posizione'),
                            	       array('p.piano'))->distinct()				   
        			  		    ->where('idPlanimetria = ?', $idplan);
		
        return $this->fetchRow($select);
    }
	
	/*public function getPianoByComp($edificio)
    {
  	    return $this->getAdapter()->fetchRow($this->select()->where('edificio = ?', $edificio));
    }*/
    
	public function getIdPlanimetriaByEdificioPiano($edificio, $piano)
    {
        return $this->getAdapter()->fetchRow($this->select()->where('edificio = ?', $edificio)
        									  				->where('piano = ?', $piano));
    }
	
	public function getIdPosizioneByPosizionestaff($Pos)
	{
		return $this->getAdapter()->fetchAll($this->select()->where('edificio = ?', $Pos));
	}
	
	public function getIdPosizioneByEdificio($Pos)
	{
		return $this->fetchRow($this->select()->where('edificio = ?', $Pos));
	}
	
	public function getIdPlanimetriaByPosizionestaff($Pos)
	{	
		$select = $this->select()->from(array('p' => 'posizione'),
                            	     array('p.idPlanimetria'))->distinct()	
                            	  ->where('edificio = ?', $Pos);
		return $this->getAdapter()->fetchAll($select);
	}
	
	public function getIdPlanimetriaByIdPosizione($idPos)
	{
		return $this->getAdapter()->fetchRow($this->select('idPlanimetria')->where('idPosizione = ?', $idPos));
	}
	
	public function getIdPosizioneByIdPlanimetria($idPlan)
	{
		$select = $this->select()->from(array('p' => 'posizione'),
                            	     array('p.idPosizione'))	
                            	  ->where('idPlanimetria = ?', $idPlan);
		return $this->getAdapter()->fetchAll($select);
	}
	
	public function getIdPosizioneByEdPiAl($ed, $pi, $al)
	{
		return $this->getAdapter()->fetchRow($this->select('idPosizione')->where('edificio = ?', $ed)
																		 ->where('piano = ?', $pi)
																		 ->where('aula = ?', $al));
	}
	
	public function getDataByIdPosizione($idPos)
	{
		return $this->getAdapter()->fetchRow($this->select()->where('idPosizione = ?', $idPos));
	}

     public function deletePosizioneByIdPlan($IdPlan)
    {
        $dove="idPlanimetria='". $IdPlan. "'";
        $this->delete($dove);
    }
   
}
