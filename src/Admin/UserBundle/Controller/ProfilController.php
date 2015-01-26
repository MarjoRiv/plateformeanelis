<?php

namespace Admin\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Admin\UserBundle\Entity\User;
use Admin\UserBundle\Form\UserType;
use Admin\UserBundle\Form\UserHandler;
use Admin\UserBundle\Manager\UserManager;
use Application\MainBundle\Manager\LogManager;

class ProfilController extends Controller
{
    public function indexAction()
    {
        return $this->render('AdminUserBundle:Default:index.html.twig');
    }

    public function showAction(User $user)
    {


       /* $type = $this->get('fos_elastica.index.afsy.user');

        $query_part = new \Elastica\Query\Bool();
        $query_part->addShould(
            new \Elastica\Query\Term(array('name' => array('value' => 'Santiago', 'boost' => 3)))
        );
        $filters = new \Elastica\Filter\Bool();
        $filters->addMust(
            new \Elastica\Filter\Term(array('id' => '1'))
        );

        $query = new \Elastica\Query\Filtered($query_part, $filters);

        $type->search($query);*/

        //print_r($type);


        return $this->render('AdminUserBundle:Profile:show.html.twig', array(
            'user' => $user));
    }

    public function editAction(User $user) {
        
        // Vérification de l'id pour des raisons de sécurités
        if($user->getId() != $this->get('security.context')->getToken()->getUser()->getId())
        {
            return $this->redirect($this->generateUrl('user_edit_profile', array('id' => $this->get('security.context')->getToken()->getUser()->getId())));
        }

        $manager = new UserManager($this);
        
        $entity = new UserType();
        $form = $this->createForm(new UserType(), $user);
        $formHandler = new UserHandler($form, $this->get('request'), $manager);
            
        if ($formHandler->process()) {
            LogManager::save($this, "Modification de l'utilisateur " . $user->getId());
            $this->get('session')->getFlashBag()->add('success', "L'utilisateur a été modifié.");

        }

        return $this->render('AdminUserBundle:Profile:user.edit.html.twig', array(
                "form" => $form->createView(),
        ));
        
    }

}
