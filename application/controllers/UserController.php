<?php

class UserController extends Zend_Controller_Action
{
    protected $_mcform;
    
    public function init()
    {
        $this->_helper->layout->setLayout('user');    
        $this->_authService = new Application_Service_Auth();
        $this->view->mcForm=$this->getModcredenzialiForm();
    }
    
    public function indexAction()
    {} 
    
    public function viewstaticAction () 
    {}
    
    public function profiloAction () 
    {}
    
    public function modprofiloAction () 
    {}
    
    public function modcredenzialiAction () 
    {}
    
    protected function getModcredenzialiForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_mcform = new Application_Form_User_Modcredenziali();
        $this->_mcform->setAction($urlHelper->url(array(
            'controller' => 'utente',
            'action' => 'index'),
            'default'
        ));
        return $this->_mcform;
    }

}