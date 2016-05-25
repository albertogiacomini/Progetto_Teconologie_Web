<?php

class AccessController extends Zend_Controller_Action
{
    protected $_form;
    protected $_authService;
    
    public function init()
    {
        $this->_helper->layout->setLayout('login');
        $this->_authService = new Application_Service_Auth();
        $this->view->loginForm = $this->getLoginForm();
        $this->view->registerForm=$this->getRegForm();
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
        $this->view->assign('msg',$request);
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
                'controller' => 'public',
                'action' => 'index'),
                'default'
                ));
        return $this->_form;
    
    }       

}