<?php

namespace AdminBundle\Admin;


use Application\Sonata\UserBundle\Entity\User;
use Sonata\AdminBundle\Admin\Admin;

abstract class BaseAdmin extends Admin
{

    /**
     * @return User
     */
    protected function getUser()
    {
        return $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser();
    }

}

