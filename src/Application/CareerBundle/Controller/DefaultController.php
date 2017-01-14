<?php

namespace Application\CareerBundle\Controller;

use Application\CareerBundle\Entity\Career;

use Application\CareerBundle\Form\CareerHandler;
use Application\CareerBundle\Form\CareerType;
use Application\CareerBundle\Manager\CareerManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ApplicationCareerBundle:Default:index.html.twig');
    }

    public function addAction(Request $request) {
        $career = new Career();
        $career->setUser($this->get('security.token_storage')->getToken()->getUser());
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(CareerType::class, $career);
        $formHandler = new CareerHandler($form, $request, $em);
        
        if ($formHandler->process()) {
            return $this->redirect($this->generateUrl('application_career_homepage'));
        }

        return $this->render('ApplicationCareerBundle:Career:add.html.twig', array(
            "form" => $form->createView(),
            ));
    }

    public function editAction(Request $request, Career $career) {

        if ($career->getUser() != $this->get('security.token_storage')->getToken()->getUser()) {
            return $this->redirect($this->generateUrl('application_career_homepage'));
        }

        $em = $this->getDoctrine()->getManager();
        
        $form = $this->createForm(CareerType::class, $career);
        $formHandler = new CareerHandler($form, $request, $em);
        
        if ($formHandler->process()) {
            return $this->redirect($this->generateUrl('application_career_homepage'));
        }

        return $this->render('ApplicationCareerBundle:Career:edit.html.twig', array(
            "form" => $form->createView(),
            ));
    }

    public function deleteAction(Career $career) {
        if ($career->getUser() != $this->get('security.token_storage')->getToken()->getUser()) {
            return $this->redirect($this->generateUrl('application_career_homepage'));
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($career);
        $em->flush();
        
        return $this->redirect($this->generateUrl('application_career_homepage'));
    }
}
