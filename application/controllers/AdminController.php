<?php

class AdminController extends Zend_Controller_Action
{
    protected $_vistaFaq;
    protected $_adminModel;
    protected $_user;
    protected $_mpform;
    protected $_faqform;
    
    public function init()
    {
        $this->_helper->layout->setLayout('admin'); 
        $this->_vistaFaq = new Application_Model_Vistafaq();   
        $this->_user = new Application_Model_User();
        $this->view->mpForm=$this->getModProfiloForm(); 
        $this->view->faqForm=$this->getModFaqForm(); 
    }
    
    public function indexAction()
    {}

    public function faqAction()
    {
         $Faq=$this->_vistaFaq->getFaqOrderById();
         $this->view->assign(array('faq'=>$Faq));
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
        $id=$_GET["idFaq"];
        $this->_faqform->populate($this->_vistaFaq->getFaqOrderById($id)->toArray());
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
        $this->_user->updateFaqById($values,$ID);
        $this->_helper->redirector('faq');
    }
    
}