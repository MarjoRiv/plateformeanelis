<?php
/**
 * Created by PhpStorm.
 * User: kebourgeix
 * Date: 04/12/16
 * Time: 17:37
 */

namespace Admin\UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{

    public function indexAction($name)
    {
        $admin_pool = $this->get('sonata.admin.pool');

        return array(
            'admin_pool' => $admin_pool,
            'name' => $name
        );
    }
}