<?php

class UserController extends Zend_Controller_Action
{
    public function init()
    {
        $this->_helper->layout->setLayout('user');    
        $this->_authService = new Application_Service_Auth();
    }
    
    public function indexAction()
    {} 
    
    public function viewstaticAction () 
    {}

}