<?php

class Application_Form_Staff_Gestione extends App_Form_Abstract
{
	protected $_stf;
	protected $piano;
	
    public function init()
    {
    	$this->_stf=new Application_Model_Staff();
        $piano=$this->_stf->getEdifici();
		
		
        $this->setMethod('post');
        $this->setName('getGestione');
        $this->setAction('');
		
		$this->addElement('select', 'piano', array(
            'required'   => true,
            'label'      => $this->comp,
            'MultiOptions' => $piano,
            'onChange' => '',
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
