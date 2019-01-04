<?php
/**
 * Created by PhpStorm.
 * User: Marjorie
 * Date: 04/01/2019
 * Time: 11:59
 */

namespace Application\YearbookBundle\Business;


class BusinessManager
{

    /**
     * BusinessManager constructor.
     */
    public function __construct()
    {

    }


    /**
     * Return list of messages received
     * @param \Doctrine\Bundle\DoctrineBundle\Registry $doctrine
     * @param Admin\UserBundle\Entity\User $user
     * @return mixed
     */
    public function listMessagesTo($doctrine,$user)
    {
        $repository = $doctrine->getRepository('ApplicationYearbookBundle:YearbookMessages');

        $messages = $repository->findBy(
            array('userTo' => $user),
            array('id' => 'DESC')
        );
        return $messages;
    }

    /**
     * Return list of messages send
     * @param \Doctrine\Bundle\DoctrineBundle\Registry $doctrine
     * @param Admin\UserBundle\Entity\User $user
     * @return mixed
     */
    public function listMessagesFrom($doctrine, $user)
    {
        $repository = $doctrine->getRepository('ApplicationYearbookBundle:YearbookMessages');

        $messages = $repository->findBy(
            array('userFrom' => $user),
            array('id' => 'DESC')
        );
        return $messages;
    }
    /**
     * Return list of messages send
     * @param \Doctrine\Bundle\DoctrineBundle\Registry $doctrine
     * @return mixed
     */
    public function listUsers($doctrine)
    {
        $repository = $doctrine->getRepository('ApplicationYearbookBundle:User');

        $users = $repository->findAll();

        return $users;
    }

    /**
     * Return list of messages send
     * @param \Doctrine\Bundle\DoctrineBundle\Registry $doctrine
     * @param $userId
     * @return mixed
     */
    public function messagesUser($doctrine,$userId)
    {
        $messages = $doctrine->getRepository('ApplicationYearbookBundle:YearbookMessages')->findBy(
            array('userTo' => $userId)
        );
        return $messages;
    }



}