<?php

class Application_Form_Staff_Gestione extends App_Form_Abstract
{
	protected $_stf;
	
    public function init()
    {
    	$this->_stf=new Application_Model_Staff();
        $piano=$this->_stf->getPianoByComp($this->comp)->toArray();
		
        $this->setMethod('post');
        $this->setName('getGestione');
        $this->setAction('');
		
		$this->addElement('select', 'piano', array(
            'required'   => true,
            'label'      => 'Piano',
            'MultiOptions' => $piano,
            'onChange' => '',
        ));

        $this->addElement('submit', 'aggiungi', array(
            'label'    => 'Aggiungi',
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
