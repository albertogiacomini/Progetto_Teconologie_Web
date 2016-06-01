<?php

class StaffController extends Zend_Controller_Action
{
    public function init()
    {
        $this->_helper->layout->setLayout('staff');    
        $this->_authService = new Application_Service_Auth();
		$this->view->gForm = $this->getGestioneForm();
		$this->view->mcForm=$this->getModcredenzialiForm();
        $this->view->pForm=$this->getPosizioneForm();
		$this->view->hForm=$this->getHomeForm();
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
	
    public function gestioneAction()
	{}
	
	public function homeAction () 
    {}
	
	protected function gethomeForm()
	{
		$urlHelper = $this->_helper->getHelper('url');
        $this->_hform = new Application_Form_Staff_Home();
        $this->_hform->setAction($urlHelper->url(array(
            'controller' => 'staff',
            'action' => 'index'),
            'default'
        ));
        return $this->_hform;
	}
	  
	protected function getGestioneForm()
		{
		$urlHelper = $this->_helper->getHelper('url');
        $this->_gform = new Application_Form_Staff_Gestione();
        $this->_gform->setAction($urlHelper->url(array(
            'controller' => 'staff',
            'action' => 'index'),
            'default'
        ));
        return $this->_gform;
	}
		
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