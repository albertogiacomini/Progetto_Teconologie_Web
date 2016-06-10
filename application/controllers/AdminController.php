<?php

class AdminController extends Zend_Controller_Action
{
    protected $_vistaFaq;
    protected $_adminModel;
    protected $_user;
    protected $_mpform;
    protected $_faqform;
    protected $_aggiungifaqform;
    protected $_aggiungiplanimetriaform;
    protected $_modplanimetriaform;
    protected $_aggiungimapevform;
    protected $_modmapevform;
    
    public function init()
    {
        $this->_helper->layout->setLayout('admin'); 
        $this->_vistaFaq = new Application_Model_Vistafaq();   
        $this->_user = new Application_Model_User();
        $this->view->mpForm=$this->getModProfiloForm(); 
        $this->view->faqForm=$this->getModFaqForm(); 
        $this->view->aggiungifaqForm=$this->getAggiungiFaqForm(); 
        $this->view->aggiungiplanimetriaForm=$this->getAggiungiPlanimetriaForm(); 
        $this->view->modplanimetriaForm=$this->getModificaPlanimetriaForm();
        $this->view->aggiungimapevForm=$this->getAggiungiMapEvForm();
        $this->view->modmapevForm=$this->getModificaMapEvForm(); 
    }
    
    public function indexAction()
    {}

    public function faqAction()
    {
         $Faq=$this->_vistaFaq->getFaqOrderById();
         $this->view->assign(array('faq'=>$Faq));
    }
    
    public function planimetriaAction()
    {
        
         $Planimetria=$this->_user->getPlanimetrieOrderById();
         foreach ($Planimetria as $fk=>$f) {
            $Posizione[$fk]=$this->_user->getPosizioneByIdPlanimetria($f['idPlanimetria']);
            
         }
         $this->view->assign(array('planimetria'=>$Planimetria));
         $this->view->assign(array('posizione'=>$Posizione));
    }
    
     public function mappaevaquazioneAction()
    {
         $MappaEv=$this->_user->getMappaEvaquazioneOrderById();
         $this->view->assign(array('mappaevaquazione'=>$MappaEv));
    }
    
    public function userAction()
    {
         $Utente=$this->_user->getUserOrderById();
         $this->view->assign(array('user'=>$Utente));
    }
      
     public function deleteuserAction()
    {
         $un=$_GET["username"];
         $this->_user->deleteUser($un);
         $Utente=$this->_user->getUserOrderById();
         $this->view->assign(array('user'=>$Utente));
         $this->_helper->redirector('user');
    }
      
    public function deletefaqAction()
    {
         $fq=$_GET["idfaq"];
         $this->_vistaFaq->deleteFaq($fq);
         $Faq=$this->_vistaFaq->getFaqOrderById();
         $this->view->assign(array('faq'=>$Faq));
         $this->_helper->redirector('faq');
    }
    
        
     public function modprofiloAction () 
    {
        $un=$_GET["username"];
        $this->_mpform->populate($this->_user->getUserByUName($un)->toArray());
    }
    
    public function getModProfiloForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_mpform = new Application_Form_Admin_Modprofilo();
        $this->_mpform->setAction($urlHelper->url(array(
            'controller' => 'admin',
            'action' => 'salvamodprofilo'),
            'default'
        ));
        return $this->_mpform;
    }
    
    public function salvamodprofiloAction () 
    {
        if(!$this->getRequest()->isPost()) {
            $this->_helper->redirector('modprofilo');
        }
        $form=$this->_mpform;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('modprofilo');
        }
        $values=$form->getValues();
        $ID=$_POST["idUtente"];
        $this->_user->updateUserById($values,$ID);
        $this->_helper->redirector('user');
    }
    
      public function modfaqAction () 
    {
        $id=$_GET["idfaq"];
        $this->_faqform->populate($this->_vistaFaq->getFaqById($id)->toArray());
    }
    
    public function getModFaqForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_faqform = new Application_Form_Admin_ModFaqForm();
        $this->_faqform->setAction($urlHelper->url(array(
            'controller' => 'admin',
            'action' => 'salvamodfaq'),
            'default'
        ));
        return $this->_faqform;
    }
    
    public function salvamodfaqAction () 
    {
        if(!$this->getRequest()->isPost()) {
            $this->_helper->redirector('modfaq');
        }
        $form=$this->_faqform;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('modfaq');
        }
        $values=$form->getValues();
        $ID=$_POST["idFaq"];
        $this->_vistaFaq->updateFaqById($values,$ID);
        $this->_helper->redirector('faq');
    }
    
      public function aggiungifaqAction () 
    {
        $this->_aggiungifaqform;
    }
    
    public function getAggiungiFaqForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_aggiungifaqform = new Application_Form_Admin_AggiungiFaq();
        $this->_aggiungifaqform->setAction($urlHelper->url(array(
            'controller' => 'admin',
            'action' => 'salvafaq'),
            'default'
        ));
        return $this->_aggiungifaqform;
    }
    
    public function salvafaqAction () 
    {
        if(!$this->getRequest()->isPost()) {
            $this->_helper->redirector('aggiungifaq');
        }
        $form=$this->_aggiungifaqform;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('aggiungifaq');
        }
        $values=$form->getValues();
        $this->_vistaFaq->createFaq($values);
        $this->_helper->redirector('faq');
    }
    
    public function aggiungiplanimetriaAction(){
        $this->_aggiungiplanimetriaform;
    }
    
    public function getAggiungiPlanimetriaForm(){
        $urlHelper = $this->_helper->getHelper('url');
        $this->_aggiungiplanimetriaform = new Application_Form_Admin_AggiungiPlan();
        $this->_aggiungiplanimetriaform->setAction($urlHelper->url(array(
            'controller' => 'admin',
            'action' => 'salvaplan'),
            'default'
        ));
        return $this->_aggiungiplanimetriaform;
    }
    
    public function salvaplanAction()
    {
        if(!$this->getRequest()->isPost()) {
            $this->_helper->redirector('aggiungiplanimetria');
        }
        $form=$this->_aggiungiplanimetriaform;
        
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('aggiungiplanimetria');
        }
        
        $form->preValidation($_POST);
        
        $value=$form->getValue('mappa');
        //conversione del file della form in blob
        $image=APPLICATION_PATH . '/../public/images/temp/'.$value;
        $data=file_get_contents($image);
        //immissione del file blob nella variabile imgprofilo
        
        $idplan = ($this->_user->getMaxIdPlan()+1);
        
        $valoriplan=array("idPlanimetria"=>$idplan,"mappa"=>$data,"map"=>$form->getValue('map'));
        
        $this->_user->aggiungiPlanimetria($valoriplan);
  
        for($i=1; $i<$form->getValue('id')+1;$i++){        
            $valoripos=array("idPlanimetria"=>$idplan,"edificio"=>$form->getValue('edificio'),"piano"=>$form->getValue('piano'),"aula"=>$form->getValue('aula'.($i-1)),"zona"=>$form->getValue('zona'.($i-1)));
            $this->_user->aggiungiPosizione($valoripos);
        }
        //eliminazione de file temporaneo immagine
        unlink($image);
        $this->_helper->redirector('planimetria');
    }
    
    public function deleteplanimetriaAction(){
         $pl=$_GET["idplan"];
         $this->_user->deletePlan($pl);
         $Planimetria=$this->_user->getPlanimetrieOrderById();
         $this->view->assign(array('planimetria'=>$Planimetria));
         $this->_helper->redirector('planimetria');
    }
    
    public function modificaplanimetriaAction(){
        $id=$_GET["idplan"];
        $this->_modplanimetriaform->populate($this->_user->getPlanimetriaById($id)->toArray());
    }
    
    public function getModificaPlanimetriaForm(){
        $urlHelper = $this->_helper->getHelper('url');
        $this->_modplanimetriaform = new Application_Form_Admin_Modificaplanimetria();
        $this->_modplanimetriaform->setAction($urlHelper->url(array(
            'controller' => 'admin',
            'action' => 'salvamodplan'),
            'default'
        ));
        return $this->_modplanimetriaform;
    }
    
    public function salvamodplanAction()
    {
        if(!$this->getRequest()->isPost()) {
            $this->_helper->redirector('modificaplanimetria');
        }
        $form=$this->_aggiungiplanimetriaform;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('modificaplanimetria');
        }
        $values=$form->getValues();
        //conversione del file della form in blob
        $image=APPLICATION_PATH . '/../public/images/temp/'.$values['mappa'];
        $data=file_get_contents($image);
        //immissione del file blob nella variabile imgprofilo
        $values['mappa']=$data;
        $id=$_POST["idPlanimetria"];
        $this->_user->modificaPlanimetria($values,$id);
        //eliminazione de file temporaneo immagine
        unlink($image);
        $this->_helper->redirector('planimetria');
    }
    
    
    
    
    
    public function aggiungimapevAction(){
        $this->_aggiungimapevform;
    }
    
    public function getAggiungiMapEvForm(){
        $urlHelper = $this->_helper->getHelper('url');
        $this->_aggiungimapevform = new Application_Form_Admin_AggiungiMapEv();
        $this->_aggiungimapevform->setAction($urlHelper->url(array(
            'controller' => 'admin',
            'action' => 'salvamapev'),
            'default'
        ));
        return $this->_aggiungimapevform;
    }
    
    public function salvamapevAction()
    {
        if(!$this->getRequest()->isPost()) {
            $this->_helper->redirector('aggiungimapev');
        }
        $form=$this->_aggiungimapevform;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('aggiungimapev');
        }
        $values=$form->getValues();
        //conversione del file della form in blob
        $image=APPLICATION_PATH . '/../public/images/temp/'.$values['mappaEvaquazione'];
        $data=file_get_contents($image);
        //immissione del file blob nella variabile imgprofilo
        $values['mappaEvaquazione']=$data;
        $this->_user->aggiungiMappaEvaquazione($values);
        //eliminazione de file temporaneo immagine
        unlink($image);
        $this->_helper->redirector('mappaevaquazione');
    }
    
    public function deletemapevAction()
    {
         $map=$_GET["idmapev"];
         $this->_user->deleteMapEv($map);
         $MappaEv=$this->_user->getMappaEvaquazioneOrderById();
         $this->view->assign(array('mappaevaquazione'=>$MappaEv));
         $this->_helper->redirector('mappaevaquazione');
    }
       
    public function modificamapevAction()
    {
        $id=$_GET["idmapev"];
        $this->_modmapevform->populate($this->_user->getMappaEvaquazioneById($id)->toArray());
    }
    
    public function getModificaMapEvForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_modmapevform = new Application_Form_Admin_Modificamapev();
        $this->_modmapevform->setAction($urlHelper->url(array(
            'controller' => 'admin',
            'action' => 'salvamodmapev'),
            'default'
        ));
        return $this->_modmapevform;
    }
    
    public function salvamodmapevAction()
    {
        if(!$this->getRequest()->isPost()) {
            $this->_helper->redirector('modificamapev');
        }
        $form=$this->_modmapevform;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('modificamapev');
        }
        $values=$form->getValues();
        //conversione del file della form in blob
        $image=APPLICATION_PATH . '/../public/images/temp/'.$values['mappaEvaquazione'];
        $data=file_get_contents($image);
        //immissione del file blob nella variabile imgprofilo
        $values['mappaEvaquazione']=$data;
        $id=$_POST["idMappaEvaquazione"];
        $this->_user->modificaMapEv($values,$id);
        //eliminazione de file temporaneo immagine
        unlink($image);
        $this->_helper->redirector('mappaevaquazione');
    }
    
    public function aggiungiaulaAction(){
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        if ($this->getRequest()->isXmlHttpRequest()) {
            $id = $this->_getParam('id');
            
            
            $element = new Zend_Form_Element_Text("aula$id", array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('Int')
            ),
            'value'      => $id+1,
            'readonly'   => true,
            'required'   => true,
            'label'      => 'Aula',
            'class' => 'form-control mt5',
        ));
        
        $element->setDecorators(array(
        'ViewHelper',
        array(array('alias1' => 'HtmlTag'),array('tag' => 'td', 'class' => 'element',)),
        array(array('alias2' => 'HtmlTag'), array('tag' => 'td', 'class' => 'errors','openOnly' => true, 'placement' => 'append')),
        'Errors',
        array(array('alias3' => 'HtmlTag'), array('tag' => 'td', 'closeOnly' => true, 'placement' => 'append')),
        array('Label', array('tag' => 'td')),
        
        ));
             
             $element2 = new Zend_Form_Element_Text("zona$id", array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('Int')
            ),
            'required'   => true,
            'label'      => ' --->  Zona ',
            'class' => 'form-control mt5',
        ));
        
        $element2->setDecorators(array(
        'ViewHelper',
        array(array('alias1' => 'HtmlTag'),array('tag' => 'td', 'class' => 'element',)),
        array(array('alias2' => 'HtmlTag'), array('tag' => 'td', 'class' => 'errors','openOnly' => true, 'placement' => 'append')),
        'Errors',
        array(array('alias3' => 'HtmlTag'), array('tag' => 'td', 'closeOnly' => true, 'placement' => 'append')),
        array('Label', array('tag' => 'td')),
        
        ));
        
            echo ($element.' '.$element2);
        }
    }
    

 
}