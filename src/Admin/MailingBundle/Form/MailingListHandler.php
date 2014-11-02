<?php
namespace Admin\MailingBundle\Form;

use Admin\MailingBundle\Manager\MailingListManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Form;
use Admin\MailingBundle\Entity\MailingList;

class MailingListHandler {
    
    private $form;
    private $request;
    private $manager;
    
    public function __construct(Form $form, Request $request, MailingListManager $manager)
    {
        $this->form = $form;
        $this->request = $request;
        $this->manager = $manager;
    }
    
    public function process() {
        if($this->request->getMethod() == "POST"){
            $this->form->bind($this->request);
            if($this->form->isValid()){
                $this->onSuccess($this->form->getData());
                return true;
            }
        }
    }
    
    public function onSuccess(MailingList $data) {
        $this->manager->persist($data);
        $this->manager->flush();
    }
    
}