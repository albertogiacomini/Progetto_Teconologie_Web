<?php

class Application_Resource_Utente extends Zend_Db_Table_Abstract
{
    protected $_name    = 'utente';
    protected $_primary  = 'idUtente';
    protected $_rowClass = 'Application_Resource_Utente_Item';

    public function init()
    {
    }

    public function getUserByUName($name)
    {
        $select = $this->select()->where('username = ?', $name);
        return $this->fetchRow($select);
    }
	
	public function insertUser($usrInfo)
    {
        $this->insert($usrInfo);
    }
}

