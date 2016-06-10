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
        $select = $this->select()->order('idElencoAvviso'); 
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
	
	public function updatePericoloByPosizioneStaff($posizioneStaff)
    {
    	
		$db = new Zend_Db_Adapter_Pdo_Mysql(array(
												    'host'     => 'localhost',
												    'username' => 'root',
												    'password' => 'root',
												    'dbname'   => 'grp_04_db'
												));
		$data      = array('pericolo' => '0',
							'posizioneStaff' => null);
		$where[] = $db->quoteInto('posizioneStaff = ?', $posizioneStaff); 
		$db->update($this->_name, $data, $where); 
    }
	
	public function getPericolo($edificio)
    {
        return $this->fetchRow($this->select()->where('pericolo= 1')
											  ->where('posizioneStaff= ?',$edificio));
    }
}

        
