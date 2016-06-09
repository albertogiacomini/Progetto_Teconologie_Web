<?php

class Application_Form_Staff_Segnalazioni extends App_Form_Abstract
{
    public function init()
    {
    	$_staffModel = new Application_Model_Staff(); 
        $this->setMethod('post');
        $this->setName('getSegnalazioni');
        $this->setAction('');

        $this->addElement('hidden', 'idAvviso', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(1, 25))
            ),
            'required'   => true,
            ));
        
		$edificio = $_staffModel->getEdifici();
		$this->addElement('select', 'edificio', array(
            'label'      => 'Edificio',
            'MultiOptions'=> $edificio,
                'decorators' => $this->elementDecorators, 
                'class' => 'form-control mt3',
        ));
            
        $this->addElement('text', 'aula', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Aula',
            'decorators' => $this->elementDecorators,
            'class' => 'form-control mt3',
            ));
        
        $this->addElement('text', 'username', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Username',
            'decorators' => $this->elementDecorators,
            'class' => 'form-control mt3',
            ));
            
         $this->addElement('text', 'password', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Password',
            'decorators' => $this->elementDecorators,
            'class' => 'form-control mt3',
            ));
            
        $this->addElement('radio', 'genere', array(
            'label'      => 'Genere',
            'MultiOptions'=>array(
                'male' => 'M',
                'female' => 'F',),
            'decorators' => $this->radioDecorators,
            'class' => 'mt3',
        ));
            
        $this->addElement('text', 'email', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 35))
            ),
            'required'   => true,
            'label'      => 'E-mail',
            'decorators' => $this->elementDecorators,
            'class' => 'form-control mt3',
        )); 
            
        $this->addElement('text', 'eta', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Nascita',
            'decorators' => $this->elementDecorators,
            'class' => 'form-control mt3',
        )); 

        $this->addElement('text', 'telefono', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array('Int'),
            'required'   => true,
            'label'      => 'Telefono',
            'decorators' => $this->elementDecorators,
            'class' => 'form-control mt3',
        ));
        
        $this->addElement('select', 'livello', array(
            'label'      => 'Livello',
            'MultiOptions'=>array(
                'admin' => 'admin',
                'staff' => 'staff',
                'user' => 'user',),
                'decorators' => $this->elementDecorators, 
                'class' => 'form-control mt3',
        ));
            
        $this->addElement('submit', 'aggiorna', array(
            'label'    => 'Aggiorna',
            'decorators' => $this->buttonDecorators,
            'class' => 'btn-theme form-control mt20'
        ));


        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table', 'class' => 'zend_form')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
    }
}
