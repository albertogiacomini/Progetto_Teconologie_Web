<?php

class Application_Form_Staff_Gestione extends App_Form_Abstract
{
	protected $_stf;
	
    public function init()
    {
    	$this->_stf=new Application_Model_Staff();
		$session = new Zend_Session_Namespace('session');
		
        $this->setMethod('post');
        $this->setName('getGestione');
        $this->setAction('');
		
        $un = $session->_username;
		$idPos = $this->_stf->getUserByUName($un);
		$piani = $this->_stf->getPianoByEdificio($idPos['posizioneStaff']);
        $this->addElement('select', 'piano', array(
            'required'   => true,
            'label'      => 'Piano',
            'MultiOptions' => array('0' => '-- Seleziona Piano --'),
            'onChange' => 'FillMap()',
            'class'    => 'form-control'
            ));
			
		$i = 1;
		foreach ($piani as $ed) {
			$this->piano->addMultiOption($i,$ed['piano']);
			$i = $i+1;
		}
		
		
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table', 'class' => 'zend_form')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
    }
}
