<?php

namespace Application\CotisationBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Application\CotisationBundle\Entity\Cotisation;
use Application\CotisationBundle\Entity\Invoice;

class CotisListener {

    public function postPersist(LifecycleEventArgs $args) {

        $entity = $args->getEntity();
        $em = $args->getEntityManager();

        if($entity instanceof Cotisation) {
            $invoice = new Invoice();
            $invoice->setCotisation($entity);
            $invoice->setPayed(false);
            $invoice->setDate(new \DateTime('now'));

            $entity->setNameCotisation($entity->getTypeCotisation()->getName());
            $entity->setPriceCotisation($entity->getTypeCotisation()->getPrice());
            $entity->setInvoice($invoice);


            $em->persist($invoice);
            $em->flush();
        }
    }
}