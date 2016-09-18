<?php

namespace AdminBundle\Controller;

use AppBundle\Entity\Store;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StoreController extends Controller
{
    /**
     *  @Route("/stroe/{id}", name="store")
     * @param Store $store
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Store $store)
    {
        return $this->render('store/index.html.twig', array(
            'store' => $store,
        ));
    }

}

