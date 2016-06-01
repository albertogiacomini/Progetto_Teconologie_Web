<?php

class StaffController extends Zend_Controller_Action
{
    public function init()
    {
        $this->_helper->layout->setLayout('staff');    
        $this->_authService = new Application_Service_Auth();
    }
    
    public function indexAction()
    {
    	$urlHelper = $this->_helper->getHelper('url');
        $this->_mcform = new Application_Form_User_Modcredenziali();
        $this->_mcform->setAction($urlHelper->url(array(
            'controller' => 'staff',
            'action' => 'index'),
            'default'
        ));
        return $this->_mcform;
    } 
    
    public function viewstaticAction () 
    {}

}