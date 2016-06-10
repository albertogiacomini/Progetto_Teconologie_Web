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
        
        
        $this->addElement('hidden', 'id', array(
            'value' => 1    
           ));
        
         $this->addElement('file', 'mappa', array(
            'label' => 'Planimetria',
            'destination' => APPLICATION_PATH . '/../public/images/temp',
            'order'    => 1,
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
            'order'    => 2,
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
            'order'    => 3,
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
            'order'    => 4,
        ));
        
           
        $this->addElement('submit', 'conferma', array(
            'label'    => 'Conferma',
            'decorators' => $this->elementDecorators,
            'class' => 'btn-theme form-control mt5',
            'order'    => 5,
        ));
        
         $this->addElement('button', 'aggiungiaula', array(
            'label'      => 'Aggiungi aula',
            'decorators' => $this->elementDecorators,
            'class' => 'form-control btn-theme  mt5',
            'onClick' => 'AggiungiAula()',
            'order'    => 6,
        ));
        
        $this->addElement('text', 'aula0', array(
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
            'order'    => 7,
        ));
        
         $this->addElement('text', 'zona0', array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('Int')
            ),
            'required'   => true,
            'label'      => ' --->  Zona ',
            'decorators' => $this->element2Decorators,
            'class' => 'form-control mt5',
            'order'    => 8,
        ));
     

        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table', 'id'=>'tabellaAddPlan', 'class' => 'zend_form')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));
    }
    
    
        /**
     * After post, pre validation hook
     * 
     * Finds all fields where name includes 'newName' and uses addNewField to add
     * them to the form object
     * 
     * @param array $data $_GET or $_POST
     */
    public function preValidation(array $data) {
    
      // array_filter callback
      function findFields($field) {
        // return field names that include 'newName'
        if (strpos($field, 'aula') !== false) {
          return $field;
        }
      }
      
      function findFields2($field2) {
        // return field names that include 'newName'
        if (strpos($field2, 'zona') !== false) {
          return $field2;
        }
      }
    
      // Search $data for dynamically added fields using findFields callback
      $newFields = array_filter(array_keys($data), 'findFields');
      $newFields2 = array_filter(array_keys($data), 'findFields2');
      
      foreach ($newFields as $fieldName) {
        // strip the id number off of the field name and use it to set new order
        $order = ltrim($fieldName, 'aula') + 2;
        $this->addNewField($fieldName, $data[$fieldName], $order);
      }
      
      
       foreach ($newFields2 as $fieldName2) { 
        $order = ltrim($fieldName2, 'zona') + 2;
        $this->addNewField($fieldName2, $data[$fieldName2], $order);
       }
    }
    
    /**
     * Adds new fields to form
     *
     * @param string $name
     * @param string $value
     * @param int    $order
     */
    public function addNewField($name, $value, $order) {
            
        $this->addElement('text', $name, array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('Int')
            ),
            'value'      => $value,
            'readonly'   => true,
            'required'   => true,
            'label'      => 'Aula',
            'decorators' => $this->element2Decorators,
            'class' => 'form-control mt5',
            'order'    => $order,
        ));
    }
    
    public function addNewField2($name, $value, $order) {
        
         $this->addElement('text', $name, array(
            'filters'    => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('Int')
            ),
            'required'   => true,
            'value'      => $value,
            'label'      => ' --->  Zona ',
            'decorators' => $this->element2Decorators,
            'class' => 'form-control mt5',
            'order'    => $order,
        ));
    }




}
