<?php

class Application_Form_Staff_Posizione extends App_Form_Abstract
{
    protected $_usr;
    
    public function init()
    {
        $this->_usr=new Application_Model_User();
        $edificio=$this->_usr->getEdifici();
        $this->setMethod('post');
        $this->setName('setPosizione');
        $this->setAction('');
        
        $this->addElement('select', 'edificio', array(
            'required'   => true,
            'label'      => 'Edificio',
            'MultiOptions' => $edificio,
            ));
            
        $this->addElement('select', 'posizione', array(
            'required'   => true,
            'label'      => 'Livello',
            //'MultiOptions' => '',
            ));
        
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table', 'class' => 'zend_form')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
    }
}
