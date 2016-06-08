<?php

class Application_Form_Admin_AggiungiMapEv extends App_Form_Abstract
{
    protected $_userModel;
    
    public function init()
    {
        $this->_userModel = new Application_Model_User();              
        $this->setMethod('post');
        $this->setName('aggiungiMapEv');
        $this->setAction('');
        
         $this->addElement('file', 'mappaEvaquazione', array(
            'label' => 'Mappa evacuazione',
            'destination' => APPLICATION_PATH . '/../public/images/temp',
            'validators' => array( 
                    array('Count', false, 1),
                    array('Size', false, 102400),
                    array('Extension', false, array('jpg', 'gif', 'png'))),
            'decorators' => $this->fileDecorators,
                    )); 
            
        $this->addElement('text', 'edificio', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 45))
            ),
            'required'   => true,
            'label'      => 'Edificio',
            'decorators' => $this->elementDecorators,
            'class' => 'form-control mt5',
        ));
        
        $this->addElement('text', 'piano', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 45))
            ),
            'required'   => true,
            'label'      => 'Piano',
            'decorators' => $this->elementDecorators,
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
