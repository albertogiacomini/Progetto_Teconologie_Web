<?php

class Application_Form_Admin_ModFaqForm extends App_Form_Abstract
{
    protected $_vistafaqModel;
    
    public function init()
    {
        $this->_vistafaqModel = new Application_Model_Vistafaq();              
        $this->setMethod('post');
        $this->setName('modProfilo');
        $this->setAction('');
        
        $this->addElement('hidden', 'idFaq', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(1, 25))
            ),
            'required'   => true,
            ));
        
        $this->addElement('text', 'domanda', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 10000))
            ),
            'required'   => true,
            'label'      => 'Domanda',
            'decorators' => $this->elementDecorators,
         ));
            
        $this->addElement('text', 'risposta', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 10000))
            ),
            'required'   => true,
            'label'      => 'Risposta',
            'decorators' => $this->elementDecorators,
        ));
        
        $this->addElement('submit', 'aggiorna', array(
            'label'    => 'Aggiorna',
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
