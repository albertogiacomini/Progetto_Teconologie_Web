<?php

class StaffController extends Zend_Controller_Action
{
	protected $_mcform;
    protected $_pform;
    protected $_avvisi;
    protected $_mpform;
	protected $_asform;
    protected $_epform;
	protected $_evaform;
	protected $_gform;
	protected $_staff;
	protected $_sede;
	protected $_username;
	protected $_segnform;
	protected $_iform;
	protected $_edificio;
	protected $_piano;
	protected $_avviso;

	
    public function init()
    {
        $this->_helper->layout->setLayout('staff');    
        $this->_authService = new Application_Service_Auth();
		$this->_staff=new Application_Model_Staff();
		
		$this->view->mcForm=$this->getModcredenzialiForm();
		$this->view->mpForm=$this->getModprofiloForm();
        $this->view->pForm=$this->getPosizioneForm();
		$this->view->iForm=$this->getIndexForm();
		$this->view->asForm=$this->getAggiungisegnalazioneForm();
		$this->view->epForm=$this->getEliminaprofiloForm();
		$this->view->evaForm=$this->getEvaForm();
		//$this->view->segnForm=$this->getSegnalazioniForm();
		$this->view->gForm = $this->getGestioneForm();
		$session = new Zend_Session_Namespace('session'); 
		$session->_username = $this->_authService->getIdentity()->username;
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
	
	public function profiloAction ()
    {}
    
    public function avvisiareeAction ()
    {
       
        $flag='true';
        $count[]=0;
        $totcount=0;
        $staffedif=$this->_authService->getIdentity()->posizioneStaff;
        $pian=$this->_staff->getPianoByEdificio($staffedif);
        
        $this->view->assign(array('staffedif'=>$staffedif));
        $this->view->assign('flag',$flag);
        $this->view->assign('tcou',$totcount);
    }
	

	public function datiareeAction () 
    {
        $flag='false';
        $cou[]=null;
        $coua[]=null;
        $dove=$this->_staff->getPosizione();
        $nutenti=$this->_staff->getUserOrderById();
        $avv=$this->_staff->getAvvisi();
        $staffedif=$this->_authService->getIdentity()->posizioneStaff;
        foreach ($dove as $dk => $d) {
            $cou[]=null;
            $coua[]=null;
            if($staffedif==$d['edificio']){
                foreach ($nutenti as $nu){
                    if($d['idPosizione']==$nu['idPosizione'])
                        $cou[$dk]+=1;
                        $flag='true';
                }
                foreach ($avv as $a){
                    if($d['idPosizione']==$a['idPosizione'])
                        $coua[$dk]+=1;
                        $flag='true';
                }
             }
        }
        $this->view->assign(array('nutenti'=>$nutenti));
        $this->view->assign(array('staffedif'=>$staffedif));
        $this->view->assign(array('dove'=>$dove));
        $this->view->assign(array('cou'=>$cou));
        $this->view->assign(array('coua'=>$coua));
        if(!null==$_GET)
        $this->view->assign('piano',$_GET["piano"]);
        if(null==$_GET)
        $this->view->assign('piano',null);
        $this->view->assign('flag',$flag);
        
    }
	
	public function evaannullAction (){
		$un=$this->_authService->getIdentity()->username;
		$user=$this->_staff->getUserByUName($un);
		$this->_staff->updatePericoloByPosizioneStaff($user['posizioneStaff']);
		$this->_helper->redirector('eva');
	}
	
	
	public function evaAction () {
		$un=$this->_authService->getIdentity()->username;
		$user=$this->_staff->getUserByUName($un);
		if($this->_staff->getPericolo($user['posizioneStaff']))
		{
			$this->view->per = '1';
		}
	}
	
	public function evauAction () //evaquazione ingegneria action
    {
		if(!$this->getRequest()->isPost()) {
            $this->_helper->redirector('eva');
        }
        $form=$this->_evaform;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('eva');
        }
        $idAvv=$form->getValue('avvisi');
		
		if($idAvv != '0'){
			$un=$this->_authService->getIdentity()->username;
			$user=$this->_staff->getUserByUName($un);
			$idPos = $this->_staff->getIdPosizioneByEdificio($user['posizioneStaff']);
			$date = new Zend_Date(); 
			$createdDate= $date->get('YYYY-MM-dd HH:mm:ss');
			$avviso = (array('idPosizione'=>$idPos['idPosizione'],
							  'idUtente'=> $user['idUtente'],
							  'data'=>$createdDate,
							  'idElencoAvviso'=>$idAvv,
							  'pericolo'=>'1',
							  'posizioneStaff'=>$user['posizioneStaff'],
			));
			$this->_staff->inserisciSegnalazione($avviso);
			$this->_helper->redirector('eva');			
		}else{
			$form->setDescription('Attenzione: seleziona un cataclisma.');
            return $this->render('eva');
		}
		
    }
    
	public function segnalazioniAction()
	{
		$avvisi=$this->_staff->getAvvisi();
		$elAvvisi=$this->_staff->getAllElAvvisi();
		$pos=$this->_staff->getPosizione();
        $flag='false';
        foreach ($avvisi as $a) {
            $flag='true';
        }
		$this->view->assign(array('avvStaff'=>$avvisi));
        $this->view->assign(array('elAvvStaff'=>$elAvvisi));
        $this->view->assign(array('posStaff'=>$pos));
        $this->view->assign('flag',$flag);
	}
	
	public function deletesegnalazioneAction()
	{
		$idSegn=$_GET["segnalazione"];
		$this->_staff->deleteAvviso($idSegn);
        $this->_helper->redirector('segnalazioni');
	}
	
	public function aggiungisegnalazioneAction()
	{
		/*if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('segnalazioni');
		}
 		$form=$this->_asform;
		$values = $form->getValues();
		echo $values['edificio'];
		//$this->_staff->insertEdificio($values['edificio']);*/
       
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
    			
	}
	
	public function gestione2Action()
	{
		$this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
		
        if ($this->getRequest()->isXmlHttpRequest()) {
        	//Prendo i due parametri passati con l'ajax
            $piano = $this->_getParam('pia');
			$un=$this->_authService->getIdentity()->username;
			$user =$this->_staff->getUserByUName($un);
			$_edificio=$user['posizioneStaff'];
				
			$mappaeva=$this->_staff->getMappaEvaquazioneByEdifPiano($_edificio, $piano);
			$zone = $this->_staff->getZonaByPiano($piano);
			
			foreach ($mappaeva as $m) {
				$base64 = base64_encode($m['mappaEvaquazione']);
				$image = 'data:image/png;base64,'.$base64;
				$mappeEv[] = array('idMapp'=>$m['idMappaEvaquazione'],
									'mappa'=>$image,
									'zone' =>$zone);
			}
			
			$a = Zend_Json::encode($mappeEv);
			echo $a;
			
		}	
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
	
	protected function getEvaForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_evaform = new Application_Form_Staff_Eva();
        $this->_evaform->setAction($urlHelper->url(array(
            'controller' => 'staff',
            'action' => 'evau'),
            'default'
        ));
        return $this->_evaform;
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
	
	protected function getAggiungisegnalazioneForm()
	{
		$urlHelper = $this->_helper->getHelper('url');
        $this->_asform = new Application_Form_Staff_Aggiungisegnalazione();
        $this->_asform->setAction($urlHelper->url(array(
            'controller' => 'staff',
            'action' => 'aggiungisegnalazione'),
            'default'
        ));
        return $this->_asform;
	}
	
	protected function confermaselezioneAction(){
		
	}
}