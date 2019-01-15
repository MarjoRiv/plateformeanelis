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
        $query = $this->listUsersNotSeparated($doctrine, $userFrom);
        $query= $query->andWhere('  u.id NOT IN (:query)')
            ->orderBy('u.name', 'ASC')
            ->orderBy('u.surname', 'ASC')
            ->setParameter('query', $this->listUserSended($doctrine->getManager(), $userFrom));

        $query = $query->getQuery()->getResult();

        return $query;
    }


    /**
     * return all the students to whom the user has send a message
     * @param $em
     * @param $userFrom
     * @return mixed
     */
    private function listUserSended($em, $userFrom)
    {
        $query = $em->getRepository('ApplicationYearbookBundle:YearbookMessages')->createQueryBuilder('ym');
        $query->select('IDENTITY(ym.userTo)')
                ->where('ym.userFrom = :userFrom')
                ->setParameter('userFrom', $userFrom);
        return $query->getQuery()->getResult();
    }
    /**
     * Return list of users of zz3 who have received message from user
     * @param \Doctrine\Bundle\DoctrineBundle\Registry $doctrine
     * @return mixed
     */
    public function listUsersSend($doctrine,$userFrom)
    {
        $query = $this->listUsersNotSeparated($doctrine, $userFrom);
        $query= $query->andWhere('  u.id IN (:query)')
            ->orderBy('u.name', 'ASC')
            ->orderBy('u.surname', 'ASC')
            ->setParameter('query', $this->listUserSended($doctrine->getManager(), $userFrom));

        $query = $query->getQuery()->getResult();

        return $query;



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

    /**
     * Return all the zz3 without the user if it's also a zz3
     * @param $doctrine
     * @param $userFrom
     * @return mixed
     */
    private function listUsersNotSeparated($doctrine, $userFrom)
    {
        $query = $doctrine->getManager()
            ->getRepository('AdminUserBundle:User')
            ->createQueryBuilder('u')
            ->where('u.promotion = :promo')
            ->andWhere(' u.id <> :iduser')
            ->setParameter('iduser', $userFrom)
            ->setParameter('promo', date('Y'));
        return $query;
    }
}