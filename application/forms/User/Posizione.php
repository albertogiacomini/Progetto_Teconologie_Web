<?php

class Application_Form_User_Posizione extends App_Form_Abstract
{
    protected $_usr;
    
    public function init()
    {
        $this->_usr=new Application_Model_User();
        $edificio=$this->_usr->getEdifici()->toArray();
        
        $this->setMethod('post');
        $this->setName('setPosizione');
        $this->setAction('');
        
        $this->addElement('select', 'edificio', array(
            'required'   => true,
            'label'      => 'Edificio',
            'MultiOptions' => $edificio,
            'onChange' => 'FillPiani()',
            ));
            
         $this->addElement('select', 'piano', array(
            'required'   => true,
            'label'      => 'Piano',
            'MultiOptions' => array('0' => '-- Seleziona Piano --'),
            'onChange' => 'FillMap()',
            ));
			
		$this->addElement('image', 'mappa', array(
            'required'   => true,
            'label'      => 'Mappa',
            ));
			
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table', 'class' => 'zend_form')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
    }
}
