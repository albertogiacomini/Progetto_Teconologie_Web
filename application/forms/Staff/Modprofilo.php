<?php

class Application_Form_Staff_Modprofilo extends App_Form_Abstract
{
    protected $_userModel;
    
    public function init()
    {
        $this->_userModel = new Application_Model_User();              
        $this->setMethod('post');
        $this->setName('modProfilo');
        $this->setAction('');
        
        $this->addElement('text', 'nome', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Nome',
            'decorators' => $this->elementDecorators,
            'class' => 'form-control mt5',
            ));
            
        $this->addElement('text', 'cognome', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Cognome',
            'decorators' => $this->elementDecorators,
            'class' => 'form-control mt5',
            ));
            
        $this->addElement('radio', 'genere', array(
            'label'      => 'Genere',
            'MultiOptions'=>array(
                'male' => 'M',
                'female' => 'F',),
            'decorators' => $this->radioDecorators, 
        ));
            
        $this->addElement('text', 'email', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 35))
            ),
            'required'   => true,
            'label'      => 'E-mail',
            'decorators' => $this->elementDecorators,
            'class' => 'form-control mt5',
        )); 
            
        $this->addElement('text', 'eta', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Data di nascita',
            'decorators' => $this->elementDecorators,
            'class' => 'form-control mt5',
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
            'class' => 'form-control mt5',
        ));
            
        $this->addElement('submit', 'aggiorna   ', array(
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
