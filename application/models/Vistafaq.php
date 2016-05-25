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
}