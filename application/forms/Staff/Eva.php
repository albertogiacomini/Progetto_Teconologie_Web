<?php

class Application_Form_Staff_Eva extends App_Form_Abstract
{
    public function init()
    {
        $this->setMethod('post');
        $this->setName('getEva');
        $this->setAction('');

        $this->addElement('submit', 'evaquazione', array(
            'label'    => 'Evaquazione',
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
