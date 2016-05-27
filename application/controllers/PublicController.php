<?php

class PublicController extends Zend_Controller_Action
{
    protected $_vistaFaq;
    
    public function init()
    {
         $this->_helper->layout->setLayout('main');
         $this->_vistaFaq=new Application_Model_Vistafaq();
    }
    
    public function indexAction()
    {
        
    } 
    
    public function faqAction()
    {
         $Faq=$this->_vistaFaq->getFaqOrderById();
         $this->view->assign(array('faq'=>$Faq));
    } 
    
    public function notificheAction()
    {
         //collegamento al db per le notifiche e indirizzamento alla view
    }
    
    
    
}