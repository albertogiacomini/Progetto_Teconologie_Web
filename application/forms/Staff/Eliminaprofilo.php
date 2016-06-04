<?php

class Application_Form_Staff_Eliminaprofilo extends App_Form_Abstract
{
    public function init()
    {
        $this->setMethod('post');
        $this->setName('eliminaProf');
        $this->setAction('');
                
        $this->addElement('submit', 'elimina', array(
            'label'    => 'Eliminati',
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