<?php

class Application_Model_Admin extends App_Model_Abstract
{ 
    public function __construct()
    {
        
    }
    
    public function getUserByUName($info)
    {
        return $this->getResource('Utente')->getUserByUName($info);
    }

}