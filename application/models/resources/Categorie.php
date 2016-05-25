<?php

class Application_Resource_Categorie extends Zend_Db_Table_Abstract
{
    protected $_name    = 'categorie';
    protected $_primary  = 'idACategoria';
    protected $_rowClass = 'Application_Resource_Categorie_Item';

    public function init()
    {
    }
    
    public function getCategoriaById($Cat)
    {
        return $this->fetchRow($this->select()->where('idCategoria = ?', $Cat));
    }
}
