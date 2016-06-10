<?php

class Application_Form_Admin_AggiungiPlan extends App_Form_Abstract
{
    protected $_userModel;
    
    public function init()
    {
        $this->_userModel = new Application_Model_User();              
        $this->setMethod('post');
        $this->setName('aggiungiPlan');
        $this->setAction('');
        
        
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
            'class' => 'form-control mt5',
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
        
         $this->addElement('button', 'aggiungiAula', array(
            'label'      => 'Aggiungi aula',
            'decorators' => $this->buttonDecorators,
            'class' => 'form-control btn-theme  mt5',
            'onClick' => 'AggiungiAula()',
        ));
        
        $this->addElement('text', 'aula', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('Int')
            ),
            'value'      => 1,
            'readonly'   => true,
            'required'   => true,
            'label'      => 'Aula',
            'decorators' => $this->element2Decorators,
            'class' => 'form-control mt5',
        ));
        
         $this->addElement('text', 'zona', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('Int')
            ),
            'required'   => true,
            'label'      => ' --->  Zona ',
            'decorators' => $this->element2Decorators,
            'class' => 'form-control mt5',
        ));
        
        $this->addElement('submit', 'aggiungi', array(
            'label'    => 'Conferma',
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
