<?php

class StaffController extends Zend_Controller_Action
{
    public function init()
    {
        $this->_helper->layout->setLayout('staff');    
        $this->_authService = new Application_Service_Auth();
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
    
    public function posizioneAction () 
    {}
    
    protected function getModcredenzialiForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_mcform = new Application_Form_Staff_Modcredenziali();
        $this->_mcform->setAction($urlHelper->url(array(
            'controller' => 'staff',
            'action' => 'index'),
            'default'
        ));
        return $this->_mcform;
    }
    
    protected function getPosizioneForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_pform = new Application_Form_Staff_Posizione();
        $this->_pform->setAction($urlHelper->url(array(
            'controller' => 'staff',
            'action' => 'index'),
            'default'
        ));
        return $this->_pform;
    }
}