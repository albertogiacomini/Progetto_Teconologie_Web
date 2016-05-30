<?php

class AdminController extends Zend_Controller_Action
{
    protected $_adminModel;
    
    
    public function init()
    {
        $this->_helper->layout->setLayout('admin');    
        
    }
    
    public function indexAction()
    {}

}