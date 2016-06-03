<?php

class Application_Form_User_Eliminaprofilo extends App_Form_Abstract
{
    protected $_usr;
    
    public function init()
    {
        $this->_usr=new Application_Model_User();
        $edificio=$this->_usr->getEdifici()->toArray();
        
        $this->setMethod('post');
        $this->setName('eliminaProf');
        $this->setAction('');
                
        $this->addElement('submit', 'elimina', array(
            'label'    => 'Eliminati',
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