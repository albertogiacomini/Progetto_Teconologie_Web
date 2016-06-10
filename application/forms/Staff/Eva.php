<?php

class Application_Form_Staff_Eva extends App_Form_Abstract
{
	protected  $_stf;
	
    public function init()
    {
        $this->setMethod('post');
        $this->setName('getEva');
        $this->setAction('');
	        
	    $this->_stf=new Application_Model_Staff();
		$session = new Zend_Session_Namespace('session');
		 	
			
        $avvisi=$this->_stf->getElAvvisi();
        $this->addElement('select', 'avvisi', array(
            'required'   => true,
            'label'      => 'Selezionare CATACLISMA',
            'MultiOptions' => array('0' => '-- Seleziona Cataclisma --'),
            'class'    => 'form-control'
            ));
		
		$i = 1;
		foreach ($avvisi as $av) {
			$this->avvisi->addMultiOption($i,$av['value']);
			$i = $i+1;		
		}			
			
		$this->addElement('submit', 'evacuazione', array(
            'label'    => 'Avvia Evacuazione',
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
