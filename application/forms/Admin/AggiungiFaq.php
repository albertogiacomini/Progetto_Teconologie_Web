<?php

class Application_Form_Admin_AggiungiFaq extends App_Form_Abstract
{
    protected $_vistafaqModel;
    
    public function init()
    {
        $this->_vistafaqModel = new Application_Model_Vistafaq();              
        $this->setMethod('post');
        $this->setName('aggiungiFaq');
        $this->setAction('');
        
        $this->addElement('text', 'domanda', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 10000))
            ),
            'required'   => true,
            'label'      => 'Domanda',
            'decorators' => $this->elementDecorators,
            'class' => 'form-control',
            'class' => 'form-control mt5',
         ));
            
        $this->addElement('textarea', 'risposta', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 10000))
            ),
            'required'   => true,
            'label'      => 'Risposta',
            'decorators' => $this->elementDecorators,
            'class' => 'form-control',
            'class' => 'form-control mt5',
        ));
        
        $this->addElement('submit', 'aggiungi', array(
            'label'    => 'Aggiungi',
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
