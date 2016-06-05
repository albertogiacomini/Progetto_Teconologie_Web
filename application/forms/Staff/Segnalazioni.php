<?php

class Application_Form_Staff_Segnalazioni extends App_Form_Abstract
{
    public function init()
    {
        $this->setMethod('post');
        $this->setName('getEva');
        $this->setAction('');

		$this->addElement('submit', 'elimina', array(
            'label'    => 'Eliminati',
            'decorators' => $this->buttonDecorators,
        ));
		
        $this->addElement('submit', 'aggiungi', array(
            'label'    => 'Aggiungi',
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
