<?php

namespace Application\CotisationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Application\CotisationBundle\Entity\Cotisation;
use Application\CotisationBundle\Manager\CotisationManager;
use Application\CotisationBundle\Form\CotisationType;
use Application\CotisationBundle\Form\CotisationHandler;


class CotisationController extends Controller
{
    public function indexAction()
    {
        return $this->render('ApplicationCotisationBundle:Default:index.html.twig');
    }

    public function addAction() {
        $manager = new CotisationManager($this);
        $cotisation = new Cotisation();
        $cotisation->setUser($this->get('security.context')->getToken()->getUser());
    
        $form = $this->createForm(new CotisationType(), $cotisation);
        $formHandler = new CotisationHandler($form, $this->get('request'), $manager);
            
        if ($formHandler->process()) {
            return $this->redirect($this->generateUrl('application_cotisation_homepage'));
        }
        else {
            return $this->render('ApplicationCotisationBundle:Default:add.html.twig', array(
                "form" => $form->createView(),
            ));
        }
    }
}
