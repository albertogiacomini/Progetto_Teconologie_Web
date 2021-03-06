<?php

class Application_Form_Admin_Modprofilo extends App_Form_Abstract
{
    protected $_userModel;
    
    public function init()
    {
        $this->_userModel = new Application_Model_User();  
        $edifici=$this->_userModel->getEdifici(); 
                    
        $this->setMethod('post');
        $this->setName('modProfilo');
        $this->setAction('');
        
        $this->addElement('hidden', 'idUtente', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(1, 25))
            ),
            'required'   => true,
            ));
        
        $this->addElement('text', 'nome', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Nome',
            'decorators' => $this->elementDecorators,
            'class' => 'form-control',
            ));
            
        $this->addElement('text', 'cognome', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Cognome',
            'decorators' => $this->elementDecorators,
            'class' => 'form-control mt3',
            ));
        
        $this->addElement('text', 'username', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Username',
            'decorators' => $this->elementDecorators,
            'class' => 'form-control mt3',
            ));
            
         $this->addElement('text', 'password', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Password',
            'decorators' => $this->elementDecorators,
            'class' => 'form-control mt3',
            ));
            
        $this->addElement('radio', 'genere', array(
            'label'      => 'Genere',
            'MultiOptions'=>array(
                'male' => 'M',
                'female' => 'F',),
            'decorators' => $this->radioDecorators,
            'class' => 'mt3',
        ));
            
        $this->addElement('text', 'email', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 35))
            ),
            'required'   => true,
            'label'      => 'E-mail',
            'decorators' => $this->elementDecorators,
            'class' => 'form-control mt3',
        )); 
            
        $this->addElement('text', 'eta', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 25))
            ),
            'required'   => true,
            'label'      => 'Nascita',
            'decorators' => $this->elementDecorators,
            'class' => 'form-control mt3',
        )); 

        $this->addElement('text', 'telefono', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array('Int'),
            'required'   => true,
            'label'      => 'Telefono',
            'decorators' => $this->elementDecorators,
            'class' => 'form-control mt3',
        ));
        
        $this->addElement('select', 'livello', array(
            'label'      => 'Livello',
            'MultiOptions'=>array(
                'admin' => 'admin',
                'staff' => 'staff',
                'user' => 'user',),
                'decorators' => $this->elementDecorators, 
                'class' => 'form-control mt3',
        ));
        
       $this->addElement('select', 'posizioneStaff', array(
            'required'   => true,
            'label'      => 'Edificio',
            'MultiOptions' => array('0' => '-- Seleziona Immobile --'),
            'decorators' => $this->elementDecorators, 
            'class'    => 'form-control mt3'
            ));
        
        $i = 1;
        foreach ($edifici as $ed) {
            $this->posizioneStaff->addMultiOption($i,$ed['value']);
            $i = $i+1;
        }
            
        $this->addElement('submit', 'aggiorna', array(
            'label'    => 'Aggiorna',
            'decorators' => $this->buttonDecorators,
            'class' => 'btn-theme form-control mt20'
        ));

        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
    }
}
