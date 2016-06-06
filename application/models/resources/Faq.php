<?php

class Application_Resource_Faq extends Zend_Db_Table_Abstract
{
    protected $_name     = 'faq';
    protected $_primary  = 'idFaq';
    protected $_rowClass = 'Application_Resource_Faq_Item';

    public function init()
    {
        
    }
    
    public function getFaqOrderById()
    {
       $select = $this->select()->order('idFaq');
       return $this->fetchAll($select);
    }
    
    public function deleteFaq($idFaq)
    {
        $dove="idFaq='". $idFaq. "'";
        $this->delete($dove);
    }
    
        public function updateFaqById($faqInfo,$idFaq)
    {
        $dove="idFaq='". $idFaq. "'";
        $this->update($faqInfo,$dove);
    }
}