<?php

namespace Application\TaskBundle\Controller;

use Application\TaskBundle\Entity\Task;
use Application\TaskBundle\Entity\Tag;
use Application\TaskBundle\Form\Type\TaskType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ApplicationTaskBundle:Default:index.html.twig');
    }

    public function newAction(Request $request)
    {
        $task = new Task();

        // code de test - le code ci-dessous est simplement là pour que la
        // Task ait quelques tags, sinon, l'exemple ne serait pas intéressant
        $tag1 = new Tag();
        $tag1->name = 'tag1';
        $task->getTags()->add($tag1);
        $tag2 = new Tag();
        $tag2->name = 'tag2';
        $task->getTags()->add($tag2);
        // fin du code de test

        $form = $this->createForm(new TaskType(), $task);

        // analyse le formulaire quand on reçoit une requête POST
        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                // ici vous pouvez par exemple sauvegarder la Task et ses objets Tag
            }
        }

        return $this->render('ApplicationTaskBundle:Task:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
