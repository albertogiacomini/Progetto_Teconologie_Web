<?php

class Application_Form_Staff_Aggiungisegnalazione extends App_Form_Abstract
{
	protected $_staffModel;
	
	public function init()
    {
    	$this->_staffModel = new Application_Model_Staff();              
        $this->setMethod('post');
        $this->setName('aggiungisegnalazione');
        $this->setAction('segnalazioni');
        
        $this->addElement('text', 'edificio', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Edificio',
            'decorators' => $this->elementDecorators,
            'class' => 'form-control2 mt5 ml3',
            ));
            
        $this->addElement('text', 'piano', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Piano',
            'decorators' => $this->elementDecorators,
            'class' => 'form-control2 mt5 ml3',
            ));
            
        $this->addElement('text', 'aula', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Aula',
            'decorators' => $this->elementDecorators,
            'class' => 'form-control2 mt5 ml3',
            ));
			
		$elencoavvisi = $this->_staffModel->getElAvvisi();
		 $this->addElement('select', 'tiposegnalazione', array(
            'required'   => true,
            'label'      => 'Cataclisma',
            'MultiOptions' =>  array('0' => '-- Seleziona --'),
            'class' => 'form-control mt5',
            ));
		$i = 1;
		foreach ($elencoavvisi as $ea) {
			$this->tiposegnalazione->addMultiOption($i,$ea['value']);
			$i = $i+1;				
		}
		
        $this->addElement('submit', 'segnalazione', array(
            'label'    => 'Invia Segnalazione',
            'decorators' => $this->buttonDecorators,
            'class' => 'btn-theme form-control3 mt20'
        ));

        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table', 'class' => 'zend_form')),
        	array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
    }
}
