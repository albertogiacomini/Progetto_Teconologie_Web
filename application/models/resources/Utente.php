<?php

class Application_Resource_Utente extends Zend_Db_Table_Abstract
{
    protected $_name    = 'utente';
    protected $_primary  = 'idUtente';
    protected $_rowClass = 'Application_Resource_Utente_Item';

    public function init()
    {
    }

    public function getUserByName($name)
    {
        $select = $this->select()->where('username = ?', $name);
        return $this->fetchAll($select);
    }
}

