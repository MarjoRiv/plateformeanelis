<?php
namespace Application\SocialBundle\Form;

use Application\SocialBundle\Manager\MachinManager;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class MachinHandler {
    private $form;
    private $request;
    private $manager;
    
    public function __construct(Form $form, Request $request, MachinManager $manager){
        $this->form = $form;
        $this->manager = $manager;
        $this->request = $request;
    }
    
    public function process(){
        if($this->request->getMethod() == "POST") {
            $this->form->bind($this->request);
            if($this->form->isValid()){
                $this->manager->persist($this->form->getData());
                $this->manager->flush();
                return true;
            }
        }
    }
}