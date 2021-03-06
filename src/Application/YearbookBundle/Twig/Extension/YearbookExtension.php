<?php

namespace Application\YearbookBundle\Twig\Extension;
use Doctrine\ORM\EntityManager;
use Twig_SimpleFunction;

class YearbookExtension extends \Twig_Extension
{
    /**
     * @var EntityManager
     */
    protected $em;
 
    public function __construct($em)
    {
        $this->em = $em;
    }
 
    public function getName()
    {
        return 'yearbook_extension';
    }
 
    public function getFunctions()
    {
        return array(
            //  changement de Twig_Function_Method en Twig_SimpleFunction car la première est dépréciée
             new Twig_SimpleFunction('is_yearbook_activated', array($this, 'getStatus')),
             new Twig_SimpleFunction('get_promotion_activated', array($this, 'getPromotionActivated')),
        );
    }
    
    // Retourne TRUE si un Yearbook est activé pour l'année courante
    public function getStatus()
    {
        $messages = $this->em->getRepository('ApplicationYearbookBundle:Yearbook')->findBy(array(
            'promotion' => date('Y'),
            'activated' => TRUE
            )
        );
        if ( count($messages) > 0 ) {
            return TRUE;
        }
        return FALSE;
    }

    // Retourne l'année courante si la promotion de l'année courante est activéé. 0000 sinon
    public function getPromotionActivated() {
        $messages = $this->em->getRepository('ApplicationYearbookBundle:Yearbook')->findBy(array(
            'promotion' => date('Y'),
            'activated' => TRUE
            )
        );
        if ( count($messages) > 0 ) {
            return date('Y');
        }
        return "000X";
    }

}