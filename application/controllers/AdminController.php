<?php

class AdminController extends Zend_Controller_Action
{
    protected $_vistaFaq;
    protected $_adminModel;
    
    
    public function init()
    {
        $this->_helper->layout->setLayout('admin'); 
        $this->_vistaFaq=new Application_Model_Vistafaq();   
        
    }
    
    public function indexAction()
    {}

    public function faqAction()
    {
         $Faq=$this->_vistaFaq->getFaqOrderById();
         $this->view->assign(array('faq'=>$Faq));
    }    
          
}