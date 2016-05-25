<?php

class AccessController extends Zend_Controller_Action
{
    protected $_form;
    protected $_authService;
	protected $_userModel;
    
    public function init()
    {
        $this->_helper->layout->setLayout('login');
        $this->_authService = new Application_Service_Auth();
        $this->view->loginForm = $this->getLoginForm();
        $this->view->registerForm=$this->getRegForm();
		$this->_userModel = new Application_Model_User();
    }
    
    public function indexAction()
    {
        
    } 
    
    public function viewstaticAction () {
        $page = $this->_getParam('staticPage');
        $this->render($page);
    }
    
    public function loginAction()
    {
        
    }
       
    public function registrazioneAction()
    {

    }

    public function authenticateAction()
    {        
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return $this->_helper->redirector('login');
        }
        $form = $this->_form;
        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('login');
        }
        if (false === $this->_authService->authenticate($form->getValues())) {
            $form->setDescription('Autenticazione fallita. Riprova');
            return $this->render('login');
        }
        return $this->_helper->redirector('index', $this->_authService->getIdentity()->livello);
    }
    
    private function getLoginForm()
    {
            $urlHelper = $this->_helper->getHelper('url');
            $this->_form = new Application_Form_Public_Auth_Login();
            $this->_form->setAction($urlHelper->url(array(
            'controller' => 'access',
            'action' => 'authenticate'),
            'default'
        ));
        return $this->_form;
    }
    
    private function getRegForm()
    {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_form = new Application_Form_Public_Reg_Registrazione();
        $this->_form->setAction($urlHelper->url(array(
                'controller' => 'access',
                'action' => 'newreg'),
                'default'
                ));
        return $this->_form;
    
    }
	
	private function newregAcion()
    {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
		$form=$this->_form;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('registrazione');
        }
        $values = $form->getValues();
       	$this->_userModel->insertUser($values);
		$this->_helper->redirector('main'); 
    }             

}