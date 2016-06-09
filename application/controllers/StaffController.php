<?php

class StaffController extends Zend_Controller_Action
{
	protected $_mcform;
    protected $_pform;
    protected $_avvisi;
    protected $_mpform;
    protected $_epform;
	protected $_evaform;
	protected $_edificio;
	protected $_piano;
	protected $_staff;
	protected $_sede;
	protected $_segnform;
	protected $_iform;
	protected $_avviso;
	
    public function init()
    {
        $this->_helper->layout->setLayout('staff');    
        $this->_authService = new Application_Service_Auth();
		$this->_staff=new Application_Model_Staff();
		$this->view->gForm = $this->getGestioneForm();
		$this->view->mcForm=$this->getModcredenzialiForm();
		$this->view->mpForm=$this->getModprofiloForm();
        $this->view->pForm=$this->getPosizioneForm();
		$this->view->iForm=$this->getIndexForm();
		$this->view->epForm=$this->getEliminaprofiloForm();
		$this->view->evaForm=$this->getEvaForm();
		$this->view->segnForm=$this->getSegnalazioniForm();
		
    }
	
    public function indexAction()
    {

    	$avv=null;
        $not=$this->_staff->getAvvisi();

		$un=$this->_authService->getIdentity()->username;
		$user=$this->_staff->getUserByUName($un); //prendo Utente 
		$idplan=$this->_staff->getIdPlanimetriaByPosizionestaff($user['posizioneStaff']); // prendo idPlanimetrie riferite ad un edificio 
		foreach ($idplan as $key=>$p) {
			$mappa[$key]=$this->_staff->getPlanimetriaById($p['idPlanimetria']);
			$piano[$key]=$this->_staff->getPianoByIdPlan($p['idPlanimetria']);
		}
		
		foreach ($piano as $pkk => $pian) {			
			$ipbp[$pkk]=$this->_staff->getidPosizioneByPiano($pian['piano']);
			$avv[$pkk] = null;
			foreach ($ipbp[$pkk] as $kp => $ipbpf) {
				foreach ($not as $nk => $n) {
					if($ipbpf['idPosizione']==$n['idPosizione']){
							$avv[$pkk]+= 1;
					}
				}
			}
		}
		$this->view->assign(array('mappa'=>$mappa));
		$this->view->assign(array('piano'=>$piano));
		$this->view->assign(array('idpiano'=>$idplan));
		$this->view->assign(array('avv'=>$avv));
	}

	
    public function viewstaticAction () 
    {}
	
	public function profiloAction () //profilo action
    {}
	
	public function evaAction () //evaquazione ingegneria action
    {	//lato staff
    	$this->_sede=new Application_Model_Staff();
		$this->_authService = Zend_Auth::getInstance();
		$un=$this->_authService->getIdentity()->username;
		
		$user=$this->_sede->getUserByUName($un);
		$idPlan=$this->_sede->getIdPlanimetriaByPosizionestaff($user['posizioneStaff']);
		//$plan=$this->_sede->getPlanimetriaById($idPlan['idPlanimetria']);
       
	    $comp =$this->_sede->getPosizionestaffByUName($un);
				$this->view->assign(array('comp'=>$comp));
		//lato utente
		
    }
    
	public function segnalazioniAction()
	{
		$avvisi=$this->_staff->getAvvisi();
		$elAvvisi=$this->_staff->getAllElAvvisi();
		$pos=$this->_staff->getPosizione();
		$this->view->assign(array('avvStaff'=>$avvisi));
        $this->view->assign(array('elAvvStaff'=>$elAvvisi));
        $this->view->assign(array('posStaff'=>$pos));
	}
	
	public function deletesegnalazioneAction()
	{
		$idSegn=$_GET["segnalazione"];
		$this->_staff->deleteAvviso($idSegn);
        $this->_helper->redirector('segnalazioni');
	}
	
	public function aggiungisegnalazioneAction()
	{
		
	}
	
	public function modprofiloAction () 
    {
        $un=$this->_authService->getIdentity()->username;
        $this->_mpform->populate($this->_staff->getUserByUName($un)->toArray());
    }

    public function modcredenzialiAction () 
    {
        $un=$this->_authService->getIdentity()->username;
        $this->_mcform->populate($this->_staff->getUserByUName($un)->toArray());
    }
	
    public function gestioneAction()
	{
		$this->_sede=new Application_Model_Staff();
		$this->_authService = Zend_Auth::getInstance();
		$un=$this->_authService->getIdentity()->username;
		
		$comp =$this->_sede->getPosizionestaffByUName($un);
		$this->view->assign(array('comp'=>$comp));
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
        //conversione del file della form in blob
        $image=APPLICATION_PATH . '/../public/images/temp/'.$values['imgprofilo'];
        $data=file_get_contents($image);
        //immissione del file blob nella variabile imgprofilo
        $values['imgprofilo']=$data;
        
        $un=$this->_authService->getIdentity()->username;
        $this->_staff->updateUser($values,$un);
        $us=$this->_authService->getIdentity()->username;
        $pa=$this->_authService->getIdentity()->password;
        $a=array("username"=>$us,"password"=>$pa);
        $this->_authService->getAuth()->clearIdentity();
        $this->_authService->authenticate($a);
        //eliminazione de file temporaneo immagine
        unlink($image);
    }
	
	public function homeAction () //home action
    {}
	
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
        if($values['password']==$values['passwordtest']){
            unset($values['passwordtest']);
            $un=$this->_authService->getIdentity()->username;
            $this->_staff->updateUser($values,$un);
            $this->_authService->getAuth()->clearIdentity();
            $this->_authService->authenticate($values);
        }else{
            $form->setDescription('Attenzione: le password non corrispondono.');
            return $this->render('modcredenziali');
        }
    }
	
	public function posizioneevacuazioneAction () 
    {
    	$this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
		
        if ($this->getRequest()->isXmlHttpRequest()) {

			$_edificio = $this->_authService->getIdentity()->posizioneStaff;
            $_piano = $this->_getParam('pia');
			
			//Prendo l'id planimetria corretto e attraverso quello prendo la mappa corrispondente
            $idPlan = $this->_utente->getIdPlanimetriaByEdificioPiano($this->_edificio, $this->_piano);
			$mappa = $this->_utente->getPlanimetriaById($idPlan['idPlanimetria']);	
			//Istanzio la session e salvo i parametri piano ed edificio		
			$session = new Zend_Session_Namespace('session');
            $session->_piano = $this->$this->_edificio;
			$session->_edificio = $this->$this->_piano; 
			//Codifico l'immagine e assieme metto il map           
            $base64 = base64_encode($mappa['mappa']);
			$image = 'data:image/png;base64,'.$base64;
			$map = $mappa['map'];
			$a = array("mappa"=>$image,
					   "map"=>$map);
						require_once 'Zend/Json.php';
			//Codifico i dati in formato Json e li rimando indietro
			require_once 'Zend/Json.php';
            $a = Zend_Json::encode($a);
			echo $a;
        } 
    }
    
    public function aulaevacuazioneAction () 
    {
    	//Prendo l'aula passata attraverso la selezione dall'immagine
    	$aula = $this->getParam('aue');
		$us=$this->_authService->getIdentity()->username;
		$utente	 = $this->_utente->getUserByUName($us);	
			
		$dat = $this->_utente->getDataByIdPosizione($utente['idPosizione']);	
		
		$idPos = $this->_utente->getIdPosizioneByEdPiAl($dat['edificio'], $dat['piano'], $aula);
		
		$date = new Zend_Date(); 
		$createdDate= $date->get('YYYY-MM-dd HH:mm:ss');
		 
		//Creo un'istanza della sessione per poter prendere i parametri precedentemente salvati
    	$session = new Zend_Session_Namespace('session');
		
		$avviso = (array('idPosizione'=>$idPos['idPosizione'],
					  'idUtente'=> $utente['idUtente'],
					  'data'=>$createdDate,
					  'idElencoAvviso'=>$session->_idavviso,
		));
		$session = new Zend_Session_Namespace('session');
		$session->_avviso = $avviso;
		
    }
	
	protected function getIndexForm()
	{
		$urlHelper = $this->_helper->getHelper('url');
        $this->_iform = new Application_Form_Staff_Index();
        $this->_iform->setAction($urlHelper->url(array(
            'controller' => 'staff',
            'action' => 'index'),
            'default'
        ));
        return $this->_iform;
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
		
	protected function getEliminaprofiloForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_epform = new Application_Form_Staff_Eliminaprofilo();
        $this->_epform->setAction($urlHelper->url(array(
            'controller' => 'staff',
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
            'action' => 'salvamodcredenziali'),
            'default'
        ));
        return $this->_mcform;
    }
	
	protected function getModProfiloForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_mpform = new Application_Form_Staff_Modprofilo();
        $this->_mpform->setAction($urlHelper->url(array(
            'controller' => 'staff',
            'action' => 'salvamodprofilo'),
            'default'
        ));
        return $this->_mpform;
    }
	
	 protected function getEvaForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_evaform = new Application_Form_Staff_Eva();
        $this->_evaform->setAction($urlHelper->url(array(
            'controller' => 'staff',
            'action' => 'eva'),
            'default'
        ));
        return $this->_evaform;
    }
    
    protected function getPosizioneForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_pform = new Application_Form_Staff_Posizione();
        $this->_pform->setAction($urlHelper->url(array(
            'controller' => 'staff',
            'action' => 'posizione'),
            'default'
        ));
        return $this->_pform;
	}	
	
	protected function getSegnalazioniForm()
	{
		$urlHelper = $this->_helper->getHelper('url');
        $this->_segnform = new Application_Form_Staff_Segnalazioni();
        $this->_segnform->setAction($urlHelper->url(array(
            'controller' => 'staff',
            'action' => 'aggiungisegnalazione'),
            'default'
        ));
        return $this->_segnform;
	}
}