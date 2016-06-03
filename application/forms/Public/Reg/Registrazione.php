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
    	
        $this->addElement('file', 'image', array(
            'label' => 'Img profilo',
            'destination' => APPLICATION_PATH . '/../public/images/products',
            'validators' => array( 
                    array('Count', false, 1),
                    array('Size', false, 102400),
                    array('Extension', false, array('jpg', 'gif'))),
            'decorators' => $this->fileDecorators,
                    )); 
        
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
            'label'      => 'Username',
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
            
		$this->addElement('radio', 'genere', array(
			'label'      => 'Genere',
			'MultiOptions'=>array(
                'male' => 'M',
            	'female' => 'F',),
			'decorators' => $this->elementDecorators, 
		));
			
		$this->addElement('text', 'email', array(
			'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 35))
            ),
            'required'   => true,
            'label'      => 'E-mail',
            'decorators' => $this->elementDecorators,
		));	
			
		$this->addElement('text', 'eta', array(
			'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Data di nascita',
            'decorators' => $this->elementDecorators,
		));	

		$this->addElement('text', 'telefono', array(
			'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
            	array('Int'),
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Telefono',
            'decorators' => $this->elementDecorators,
		));
        
        $this->addElement('text', 'indirizzo', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('Int'),
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Indirizzo',
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
