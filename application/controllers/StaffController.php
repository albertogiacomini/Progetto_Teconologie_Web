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
	protected $_sede;
	protected $_image;
	protected $_utente;
	
    public function init()
    {
        $this->_helper->layout->setLayout('staff');    
        $this->_authService = new Application_Service_Auth();
		$this->_staff=new Application_Model_Staff();
		$this->view->gForm = $this->getGestioneForm();
		$this->view->mcForm=$this->getModcredenzialiForm();
		$this->view->mpForm=$this->getModprofiloForm();
        $this->view->pForm=$this->getPosizioneForm();
		$this->view->hForm=$this->getHomeForm();
		$this->view->epForm=$this->geteliminaprofiloForm();
		$this->view->evaingForm=$this->getEvaingForm();
		$this->view->evamedForm=$this->getEvamedForm();
		$this->view->evaecoForm=$this->getEvaecoForm();
    }
	
    public function indexAction()
    {
    	 $Not=$this->_staff->getAvvisi();
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
    {
        $un=$this->_authService->getIdentity()->username;
        $this->_mpform->populate($this->_utente->getUserByUName($un)->toArray());
    }

    public function modcredenzialiAction () 
    {
        $un=$this->_authService->getIdentity()->username;
        $this->_mcform->populate($this->_utente->getUserByUName($un)->toArray());
    }
	
    public function gestioneAction()
	{}
	
	public function salvamodprofiloAction () 
    {
        if(!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
        $form=$this->_mpform;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('modprofilo');
        }
        $values=$form->getValues();
        $un=$this->_authService->getIdentity()->username;
        $this->_utente->updateUser($values,$un);
        $us=$this->_authService->getIdentity()->username;
        $pa=$this->_authService->getIdentity()->password;
        $a=array("username"=>$us,"password"=>$pa);
        $this->_authService->getAuth()->clearIdentity();
        $this->_authService->authenticate($a);
    }
	
	public function homeAction () //home action
    {
    	$this->_sede=new Application_Model_Staff();
		$this->_authService = Zend_Auth::getInstance();
		$un=$this->_authService->getIdentity()->username;
		
		$idPos=$this->_sede->getIdPosizioneByUName($un);
		$idPlan=$this->_sede->getIdPlanimetriaByIdPosizione($idPos['idPosizione']);
		$plan=$this->_sede->getMappaById($idPlan['idPlanimetria']);
              		  
		$base64 = base64_encode($plan['mappa']);
				$this->_image = '<img src="data:image/gif;base64,' . $base64 . '" class="img-rectangolar" width="400 height=400" />';   
	}
	
	public function salvamodcredenzialiAction () 
    {
        if(!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
        $form=$this->_mcform;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('modcredenziali');
        }
        $values=$form->getValues();
        $un=$this->_authService->getIdentity()->username;
        $this->_utente->updateUser($values,$un);
        $this->_authService->getAuth()->clearIdentity();
        $this->_authService->authenticate($values);
    }
	
	public function posizioneAction () 
    {
    	$this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
		
        if ($this->getRequest()->isXmlHttpRequest()) {
            $_piano = $this->_getParam('pia');
			$_edificio = $this->_getParam('edif');
            $idPlan = $this->_utente->getIdPlanimetriaByEdificioPiano($_edificio, $_piano);
			$mappa = $this->_utente->getPlanimetriaById('1');
            $dojoData= new Zend_Dojo_Data('mappa',$mappa);
            echo $dojoData->toJson();
        } 
    }
    
    public function pianoAction () 
    {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
		
        if ($this->getRequest()->isXmlHttpRequest()) {
            $_edificio = $this->_getParam('edif');
            $edif = $this->_utente->getPianoByEdificio($_edificio);
            $dojoData= new Zend_Dojo_Data('edificio',$edif);
            echo $dojoData->toJson();
        } 
    }
	
	protected function gethomeForm()
	{
		$urlHelper = $this->_helper->getHelper('url');
        $this->_hform = new Application_Form_Staff_Home();
        $this->_hform->setAction($urlHelper->url(array(
            'controller' => 'staff',
            'action' => 'home'),
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
            'action' => 'gestione'),
            'default'
        ));
        return $this->_gform;
	}
		
	public function eliminaprofiloAction () 
    {}
		
	public function confermaeliminazioneprofiloAction()
    {
        $un=$this->_authService->getIdentity()->username;
        if($this->_utente->deleteUser($un)){
            $this->view->assign('description','Eliminazione eseguita con successo.');
        }$this->view->assign('description','Eliminazione non riuscita.');
    }
		
	protected function getEliminaProfiloForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_epform = new Application_Form_Staff_Eliminaprofilo();
        $this->_epform->setAction($urlHelper->url(array(
            'controller' => 'user',
            'action' => 'confermaeliminazioneprofilo'),
            'default'
        ));
        return $this->_epform;
    }
		
    protected function getModcredenzialiForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_mcform = new Application_Form_Staff_Modcredenziali();
        $this->_mcform->setAction($urlHelper->url(array(
            'controller' => 'staff',
            'action' => 'modcredenziali'),
            'default'
        ));
        return $this->_mcform;
    }
	
	    protected function getModProfiloForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_mpform = new Application_Form_Staff_Modprofilo();
        $this->_mpform->setAction($urlHelper->url(array(
            'controller' => 'user',
            'action' => 'salvamodprofilo'),
            'default'
        ));
        return $this->_mpform;
    }
	
	 protected function getEvaingForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_evaingform = new Application_Form_Staff_Evaing();
        $this->_evaingform->setAction($urlHelper->url(array(
            'controller' => 'staff',
            'action' => 'evaing'),
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
            'action' => 'evamed'),
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
            'action' => 'evaeco'),
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