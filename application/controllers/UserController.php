<?php

class UserController extends Zend_Controller_Action
{
    protected $_mcform;
    protected $_pform;
    protected $_ptform;
    protected $_avvisi;
    
    public function init()
    {
        $this->_helper->layout->setLayout('user');    
        $this->_authService = new Application_Service_Auth();
        $this->_avvisi=new Application_Model_User();
        $this->view->mcForm=$this->getModcredenzialiForm();
        $this->view->pForm=$this->getPosizioneForm();
        
    }
    
    public function indexAction()
    {
         $Not=$this->_avvisi->getAvvisi();
         Zend_Layout::getMvcInstance()->assign(array('arg'=>$Not));
    } 
    
    public function viewstaticAction () 
    {}
    
    public function profiloAction () 
    {}
    
    public function modprofiloAction () 
    {}
    
    public function modcredenzialiAction () 
    {}
    
    public function posizioneAction () 
    {}
    
    public function edificioAction () 
    {}
    
    public function pianoAction () 
    {}
    
    protected function getModcredenzialiForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_mcform = new Application_Form_User_Modcredenziali();
        $this->_mcform->setAction($urlHelper->url(array(
            'controller' => 'user',
            'action' => 'index'),
            'default'
        ));
        return $this->_mcform;
    }
    
    protected function getPosizioneForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_pform = new Application_Form_User_Posizione();
        $this->_pform->setAction($urlHelper->url(array(
            'controller' => 'user',
            'action' => 'index'),
            'default'
        ));
        return $this->_pform;
    }
}