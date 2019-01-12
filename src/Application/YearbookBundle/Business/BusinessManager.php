<?php
/**
 * Created by PhpStorm.
 * User: Marjorie
 * Date: 04/01/2019
 * Time: 11:59
 */

namespace Application\YearbookBundle\Business;


use Admin\UserBundle\Form\ChangePasswordFormType;
use Application\YearbookBundle\Entity\YearbookMessages;

class BusinessManager
{

    /**
     * BusinessManager constructor.
     */
    public function __construct()
    {

    }


    /**
     * Return list of messages received by $user
     * @param \Doctrine\Bundle\DoctrineBundle\Registry $doctrine
     * @param Admin\UserBundle\Entity\User $user
     * @return mixed
     */
    public function listMessagesReceived($doctrine,$user)
    {
        $repository = $doctrine->getRepository('ApplicationYearbookBundle:YearbookMessages');

        $messages = $repository->findBy(
            array('userTo' => $user),
            array('id' => 'DESC')
        );
        return $messages;
    }

    /**
     * Return list of messages send by $user
     * @param \Doctrine\Bundle\DoctrineBundle\Registry $doctrine
     * @param Admin\UserBundle\Entity\User $user
     * @return mixed
     */
    public function listMessagesSend($doctrine, $user)
    {
        $repository = $doctrine->getRepository('ApplicationYearbookBundle:YearbookMessages');

        $messages = $repository->findBy(
            array('userFrom' => $user),
            array('id' => 'DESC')
        );
        return $messages;
    }

    /**
     * Return list of users of zz3 who don't have received message from user
     * @param \Doctrine\Bundle\DoctrineBundle\Registry $doctrine
     * @param $userFrom
     * @return mixed
     */
    public function listUsersNotSend($doctrine,$userFrom)
    {
        $query = $doctrine->getManager()
            ->createQuery('       
                SELECT u
                FROM AdminUserBundle:User u 
                WHERE
                 u.promotion = :promo
                 AND u.id <> :iduser
                 AND u.id NOT IN 
                (SELECT DISTINCT  IDENTITY(ym.userTo)
                 FROM ApplicationYearbookBundle:YearbookMessages ym
                 WHERE ym.userFrom = :userFrom)
                 ORDER  BY u.name ASC, u.surname ASC')
        ->setParameter('iduser', $userFrom)
        ->setParameter('userFrom', $userFrom)
            ->setParameter('promo',date('Y'));



        $query=$query->getResult();

        return $query;
    }


    /**
     * Return list of users of zz3 who have received message from user
     * @param \Doctrine\Bundle\DoctrineBundle\Registry $doctrine
     * @return mixed
     */
    public function listUsersSend($doctrine,$userFrom)
    {
        $query = $doctrine->getManager()
            ->createQuery('
                SELECT u
                FROM AdminUserBundle:User u 
                WHERE
                 u.promotion = :promo
                 AND u.id <> :iduser
                 AND u.id IN 
                (SELECT DISTINCT  IDENTITY(ym.userTo)
                 FROM ApplicationYearbookBundle:YearbookMessages ym
                 WHERE ym.userFrom = :userFrom)
                 ORDER  BY u.name ASC, u.surname ASC')
            ->setParameter('iduser', $userFrom)
            ->setParameter('userFrom', $userFrom)
            ->setParameter('promo',date('Y'));



        $query=$query->getResult();

        return $query;
    }
    /**
     * Create new yearbook message
     * @param $user
     * @return YearbookMessages
     */
    public function newMessage($doctrine,$user,$userFrom)
    {
        $yearbookmessages = new YearbookMessages();
        $yearbookmessages->setUserFrom($userFrom);
        $yearbookmessages->setUserTo($user);
        $yearbookmessages->setCreateDate(new \DateTime());

        $yearbookmessages->setYearbook($doctrine->getRepository('ApplicationYearbookBundle:Yearbook')->findBy(array(
                'promotion' => date('Y'),
                'activated' => TRUE
            )
        )[0]);
        return $yearbookmessages;

    }

    /**
     * delete message
     * @param $doctrine
     * @param $yearbookmessage
     */
    public function deleteMessage($doctrine, $yearbookmessage)
    {
        $em = $doctrine->getManager();
        $em->remove($yearbookmessage);
        $em->flush();
    }

    /**
     * get a message send by userFrom to user
     * @param $doctrine
     * @param $user
     * @param $userFrom
     * @return mixed
     */
    public function getMessage($doctrine, $user, $userFrom)
    {
        $query = $doctrine->getRepository('ApplicationYearbookBundle:YearbookMessages')
            ->findOneBy(
                array('userTo' => $user,
                'userFrom' => $userFrom)
            );

        return $query;
    }
}