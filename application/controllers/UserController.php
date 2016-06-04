<?php

class UserController extends Zend_Controller_Action
{
    protected $_mcform;
    protected $_pform;
    protected $_utente;
    protected $_mpform;
    protected $_epform;
	protected $_edificio;
	protected $_piano;
    protected $imageBlob;
    
    public function init()
    {
        $this->_helper->layout->setLayout('user');    
        $this->_authService = new Application_Service_Auth();
        $this->_utente=new Application_Model_User();
        $this->view->mcForm=$this->getModCredenzialiForm();
        $this->view->pForm=$this->getPosizioneForm();
        $this->view->mpForm=$this->getModProfiloForm();
        $this->view->epForm=$this->getEliminaProfiloForm();
    }
    
    public function indexAction()
    {
         $Not=$this->_utente->getAvvisi();
         Zend_Layout::getMvcInstance()->assign(array('arg'=>$Not));
    } 
    
    public function viewstaticAction () 
    {}
    
    public function profiloAction () 
    {}
    
    public function modprofiloAction () 
    {
        $un=$this->_authService->getIdentity()->username;
        $this->_mpform->populate($this->_utente->getUserByUName($un)->toArray());
    }
    
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
        
        $im = file_get_contents($values['imgprofilo']);
        $imdata = base64_encode($im);
        $values['imgprofilo']=$imdata;
        
        $un=$this->_authService->getIdentity()->username;
        $this->_utente->updateUser($values,$un);
        $us=$this->_authService->getIdentity()->username;
        $pa=$this->_authService->getIdentity()->password;
        $a=array("username"=>$us,"password"=>$pa);
        $this->_authService->getAuth()->clearIdentity();
        $this->_authService->authenticate($a);
    }
    
    public function modcredenzialiAction () 

    {
        $un=$this->_authService->getIdentity()->username;
        $this->_mcform->populate($this->_utente->getUserByUName($un)->toArray());
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
    
    public function edificioAction () 
    {}
	
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
        $this->_epform = new Application_Form_User_Eliminaprofilo();
        $this->_epform->setAction($urlHelper->url(array(
            'controller' => 'user',
            'action' => 'confermaeliminazioneprofilo'),
            'default'
        ));
        return $this->_epform;
    }
    
    protected function getModCredenzialiForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_mcform = new Application_Form_User_Modcredenziali();
        $this->_mcform->setAction($urlHelper->url(array(
            'controller' => 'user',
            'action' => 'salvamodcredenziali'),
            'default'
        ));
        return $this->_mcform;
    }
    
    protected function getModProfiloForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_mpform = new Application_Form_User_Modprofilo();
        $this->_mpform->setAction($urlHelper->url(array(
            'controller' => 'user',
            'action' => 'salvamodprofilo'),
            'default'
        ));
        return $this->_mpform;
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