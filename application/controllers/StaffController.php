<?php

class StaffController extends Zend_Controller_Action
{
	protected $_mcform;
    protected $_pform;
    protected $_avvisi;
    protected $_mpform;
    protected $_epform;
	protected $_evaingform;
	protected $_evamedform;
	protected $_evaecoform;
	protected $_edificio;
	protected $_piano;
	protected $_staff;
	
    public function init()
    {
        $this->_helper->layout->setLayout('staff');    
        $this->_authService = new Application_Service_Auth();
		$this->_utente=new Application_Model_Staff();
		$this->view->gForm = $this->getGestioneForm();
		$this->view->mcForm=$this->getModcredenzialiForm();
        $this->view->pForm=$this->getPosizioneForm();
		$this->view->hForm=$this->getHomeForm();
    }
	
    public function indexAction()
    {
    	 $Not=$this->_utente->getAvvisi();
         Zend_Layout::getMvcInstance()->assign(array('arg'=>$Not));
	} 
	
    public function viewstaticAction () 
    {}
	
	public function profiloAction () //profilo action
    {}
	
	public function evaingAction () //evaquazione ingegneria action
    {}
    
    public function evamedAction () //evaquazione medicina action
    {}
    
    public function evaecoAction () //evaquazione economia action
    {}
	
    public function modprofiloAction () 
    {}
    
    public function modcredenzialiAction () 
    {}
    
    public function posizioneAction () 
    {}
	
    public function gestioneAction()
	{}
	
	public function homeAction () //home action
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
	
	 protected function getEvaingForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_evaingform = new Application_Form_Staff_Evaing();
        $this->_evaingform->setAction($urlHelper->url(array(
            'controller' => 'staff',
            'action' => 'index'),
            'default'
        ));
        return $this->_evaingform;
    }
	
    protected function getEvamedForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_evamedform = new Application_Form_Staff_Evamed();
        $this->_evamedform->setAction($urlHelper->url(array(
            'controller' => 'staff',
            'action' => 'index'),
            'default'
        ));
        return $this->_evamedform;
    }
	
	    protected function getEvaecoForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_evaecoform = new Application_Form_Staff_Evaeco();
        $this->_evaecoform->setAction($urlHelper->url(array(
            'controller' => 'staff',
            'action' => 'index'),
            'default'
        ));
        return $this->_evaecoform;
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