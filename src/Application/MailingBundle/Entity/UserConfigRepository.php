<?php
namespace Application\MailingBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Admin\UserBundle\Entity\User;

class UserConfigRepository extends EntityRepository {
    
    public function findByUserId(User $user) {
        $query = $this->getEntityManager()
        ->createQuery('SELECT p FROM ApplicationMailingBundle:UserConfig p 
                WHERE p.userId = :id')
        ->setParameter('id', $user->getId());
        try{
            return $query->getResult();
        } catch(\Doctrine\ORM\NoResultException $e){
            return null;
        }
    }
    
    /**
     * Retourne la liste des config correspondant à un abonnement à une ML
     */
    public function getRegisterConfig () {
        $query = $this->getEntityManager()->createQuery(
            'SELECT c FROM ApplicationMailingBundle:UserConfig c WHERE c.isChecked = true'
        );
        try {
            return $query->getResult();
        } catch (NoResultException $e) {
            return null;
        }
    }
}