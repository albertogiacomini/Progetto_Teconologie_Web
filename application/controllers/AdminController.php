<?php

class AdminController extends Zend_Controller_Action
{
    protected $_vistaFaq;
    protected $_adminModel;
    protected $_user;
    
    public function init()
    {
        $this->_helper->layout->setLayout('admin'); 
        $this->_vistaFaq = new Application_Model_Vistafaq();   
        $this->_user = new Application_Model_User(); 
    }
    
    public function indexAction()
    {}

    public function faqAction()
    {
         $Faq=$this->_vistaFaq->getFaqOrderById();
         $this->view->assign(array('faq'=>$Faq));
    }
    
    public function userAction()
    {
         $Utente=$this->_user->getUserOrderById();
         $this->view->assign(array('user'=>$Utente));
    }
          
}