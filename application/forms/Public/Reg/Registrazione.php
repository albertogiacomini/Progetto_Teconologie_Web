<?php

class Application_Form_Public_Reg_Registrazione extends App_Form_Abstract
{
	protected $_userModel;
	
	public function init()
    {
    	$this->_userModel = new Application_Model_User();              
        $this->setMethod('post');
        $this->setName('registrazione');
        $this->setAction('');
    	
        $this->addElement('text', 'nome', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Nome',
            'decorators' => $this->elementDecorators,
            ));
            
        $this->addElement('text', 'cognome', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Cognome',
            'decorators' => $this->elementDecorators,
            ));
            
        $this->addElement('text', 'username', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Email',
            'decorators' => $this->elementDecorators,
            ));
        
        $this->addElement('password', 'password', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Password',
            'decorators' => $this->elementDecorators,
            ));
            
        $this->addElement('submit', 'login', array(
            'label'    => 'Registrati',
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
