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
        return $this->fetchAll($select); 
    }
    
	 public function deleteAvviso($idAvviso)
    {
        $dove="idAvviso='". $idAvviso. "'";
        $this->delete($dove);
	}
	
    public function getAvvisiByDate()
    {
        $select = $this->select()->order('data DESC'); 
        return $this->fetchAll($select); 
    }
	
	public function getAvvisiByDateEidPosizione($pos)
    {
        return $this->getAdapter()->fetchRow($this->select()->where('idPosizione= ?', $pos));
      //->order('data DESC')
    }
	
	public function inserisciSegnalazione($seInfo)
    {
        $this->insert($seInfo);
	}
	
	public function getAvvisiByidPosizione($pos)
    {
        return $this->fetchRow($this->select()->where('idPosizione= ?', $pos));
    }
	
	public function getAvvisoByIdUtente($IdUtente, $MM, $yyyy, $dd)
	{
		$data = ($yyyy.'-'.$MM.'-'.$dd);
		$select = $this->select()->where('idUtente = ?' ,$IdUtente)
								 ->where('data LIKE ?' ,$data.'%');
		return $this->getAdapter()->fetchAll($select);
	}
	
	public function getPericolo()
    {
        return $this->getAdapter()->fetchRow($this->select()->where('pericolo= 1'));
    }
}

        
