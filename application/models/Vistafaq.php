<?php

class Application_Model_Vistafaq extends App_Model_Abstract
{
    public function __construct()
    {
             
    } 

    public function getFaqOrderById()
    {
        return $this->getResource('Faq')->getFaqOrderById();
    }
    
    public function deleteFaq($idfaq)
    {
        return $this->getResource('Faq')->deleteFaq($idfaq);
    }
    
    public function updateFaqById($FaqI,$ID)
    {
        return $this->getResource('Faq')->updateFaqByID($FaqI,$ID);
    }
}