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
         $this->view->assign(array('planimetria'=>$Planimetria));
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
        $values=$form->getValues();
        //conversione del file della form in blob
        $image=APPLICATION_PATH . '/../public/images/temp/'.$values['mappa'];
        $data=file_get_contents($image);
        //immissione del file blob nella variabile imgprofilo
        $values['mappa']=$data;
        $this->_user->aggiungiPlanimetria($values);
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
        $this->_modplanimetriaform->populate($this->_user->getPlanimetriaById($id));
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
        $id=$_POST["idPlanimetria"];;
        $this->_user->modificaPlanimetria($values,$id);
        //eliminazione de file temporaneo immagine
        unlink($image);
        $this->_helper->redirector('planimetria');
    }
 
}