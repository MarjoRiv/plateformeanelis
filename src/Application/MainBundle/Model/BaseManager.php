<?php

namespace Application\MainBundle\Model;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class BaseManager {
    /**
     * 
     * @var EntityManager
     */
    private $em;
    
    public function __construct(Controller $controller) {
        $this->em = $this->getEntityManager();
    }
    
    /**
     * @return EntityManager
     */
    public function getEntityManager() {
        return $this->em;
    }
    
    /**
     * @return EntityRepository
     */
    public function getRepository() {
        return $this->getEntityManager()->getRepository($this->getNamespaceEntity());
    }
    
    public function findAll() {
        return $this->getRepository()->findAll();
    }
    
    public function persist($entity) {
        $this->em->persist($entity);
    }
    
    public function flush() {
        $this->em->flush();
    }
    
    public function detach($entity) {
        $this->em->detach($entity);
    }
    
    public function remove($entity) {
        $this->em->remove($entity);
    }
    
    /**
     * 
     * @param unknown $alias
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function findAllQuery($alias) {
        return $this->getRepository()->createQueryBuilder($alias);
    }
    
    abstract public function getNamespaceEntity();
}