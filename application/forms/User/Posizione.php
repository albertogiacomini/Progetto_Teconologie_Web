<?php

class Application_Form_User_Posizione extends App_Form_Abstract
{
    public function init()
    {
        $this->setMethod('post');
        $this->setName('setPosizione');
        $this->setAction('');
        
        $this->addElement('select', 'edificio', array(
            'required'   => true,
            'label'      => 'Edificio',
            'decorators' => $this->elementDecorators,
            ));
            
        $this->addElement('select', 'piano', array(
            'required'   => true,
            'label'      => 'Piano',
            'decorators' => $this->elementDecorators,
            ));

        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table', 'class' => 'zend_form')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
    }
}
