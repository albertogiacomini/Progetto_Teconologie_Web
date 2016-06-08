<?php

class Application_Form_Admin_Modificaplanimetria extends App_Form_Abstract
{
    protected $_userModel;
    
    public function init()
    {
        $this->_userModel = new Application_Model_User();              
        $this->setMethod('post');
        $this->setName('modificaplanimetria');
        $this->setAction('');
        
        $this->addElement('hidden', 'idPlanimetria', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(1, 25))
            ),
            'required'   => true,
            ));
        
        $this->addElement('file', 'mappa', array(
            'label' => 'Planimetria',
            'destination' => APPLICATION_PATH . '/../public/images/temp',
            'validators' => array( 
                    array('Count', false, 1),
                    array('Size', false, 102400),
                    array('Extension', false, array('jpg', 'gif', 'png'))),
            'decorators' => $this->fileDecorators,
                    )); 
            
        $this->addElement('textarea', 'map', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 5000))
            ),
            'required'   => true,
            'label'      => 'Mappatura',
            'decorators' => $this->elementDecorators,
            'class' => 'form-control',
            'class' => 'form-control mt5',
        ));
        
        $this->addElement('submit', 'modifica', array(
            'label'    => 'modifica',
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
