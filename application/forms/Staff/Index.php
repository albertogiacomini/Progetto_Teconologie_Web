<?php

class Application_Form_Staff_Index extends App_Form_Abstract
{
	protected $_sede;
	

    public function init()
    {
		
        $this->setMethod('post');
        $this->setName('getHome');
        $this->setAction('');
		
  
        $this->addElement('submit', 'aggiorna', array(
            'label'    => 'Fottiti Home',
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
