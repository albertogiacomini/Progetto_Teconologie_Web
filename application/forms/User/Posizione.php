<?php

class Application_Form_User_Posizione extends App_Form_Abstract
{
    protected $_usr;
    
    public function init()
    {
        $this->_usr=new Application_Model_User();
        $edificio=$this->_usr->getEdifici()->toArray();
        
        $this->setMethod('post');
        $this->setName('setPosizione');
        $this->setAction('');
        
        $this->addElement('select', 'edificio', array(
            'required'   => true,
            'label'      => 'Edificio',
            'MultiOptions' => $edificio,
            ));
            
        $this->addElement('select', 'piano', array(
            'required'   => true,
            'label'      => 'Piano',
            'MultiOptions' => $edificio,
            ));
                
        $this->addElement('submit', 'subed', array(
            'label'    => 'Prosegui',
            'decorators' => $this->buttonDecorators,
        ));
        
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table', 'class' => 'zend_form')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
    }
}
