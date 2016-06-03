<?php

class Application_Form_Staff_Home extends App_Form_Abstract
{
	protected $_sede='sede';
	
    public function init()
    {	
        $this->setMethod('post');
        $this->setName('getHome');
        $this->setAction('');
		
		$this->addElement('radio', 'sede', array(
			'label' 	 =>  $this->_sede,
				'MultiOptions'=>array(
                'male' => 'M',
            	'female' => 'F',),
			'decorators' => $this->elementDecorators, 
		));
		
        $this->addElement('text', 'username', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Username',
            'decorators' => $this->elementDecorators,
            ));
  

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
