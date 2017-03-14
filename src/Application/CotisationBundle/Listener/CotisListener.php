<?php

namespace Application\CotisationBundle\Listener;

use Admin\UserBundle\Entity\User;
use Application\CotisationBundle\Entity\Cotisation;
use Application\CotisationBundle\Entity\Invoice;
use Doctrine\ORM\Event\LifecycleEventArgs;

class CotisListener {

    public function postPersist(LifecycleEventArgs $args) {

        $entity = $args->getEntity();
        $em = $args->getEntityManager();

        if ($entity instanceof Cotisation) {
            $invoice = new Invoice();
            $invoice->setCotisation($entity);
            $invoice->setPayed($entity->getPayed());
            $invoice->setDate(new \DateTime('now'));
            $entity->setInvoice($invoice);
            
            $em->persist($invoice);
            $em->flush();
        }
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $em = $args->getEntityManager();

        if ($entity instanceof Invoice){
            $entity->getCotisation()->setPayed($entity->getPayed());
            $em->persist($entity);
            $em->flush();
        }
        
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        
        /*if ($args->hasChangedField('maritalName')) { 
            $oldVal= $args->getOldValue('maritalName'); 
            $newVal= $args->getNewValue('maritalName'); 
            echo "Ancien nom : " . $oldVal;
            echo "Nouveau nom : " . $newVal;
        }*/

        if ($entity instanceof User) {
            if ($args->hasChangedField('email') && !($args->hasChangedField('isEmailValid'))) {
                $entity->setIsEmailValid(true);
                $entity->setEmail($args->getNewValue('email'));
            }
        }
    }
}




