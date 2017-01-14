<?php

namespace Application\YearbookBundle\Twig\Extension;
use Doctrine\ORM\EntityManager;
use Twig_Function;
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
            'is_yearbook_activated' => new \Twig_Function_Method($this, 'getStatus'),
            'get_promotion_activated' => new \Twig_Function_Method($this, 'getPromotionActivated'),
        );
    }
    
    // Retourne TRUE si un Yearbook est activé pour l'année courrante
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

    // Retourne l'année courante si la promotion de l'année courante est activé. 0000 sinon
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