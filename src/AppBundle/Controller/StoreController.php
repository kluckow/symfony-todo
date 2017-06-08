<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Store;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Store controller.
 *
 * @Route("store")
 */
class StoreController extends Controller
{
    /**
     * Lists all store entities.
     *
     * @Route("/", name="store_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $stores = $em->getRepository('AppBundle:Store')->findAll();

        return $this->render('store/index.html.twig', array(
            'stores' => $stores,
        ));
    }

    /**
     * Finds and displays a store entity.
     *
     * @Route("/{id}", name="store_show")
     * @Method("GET")
     */
    public function showAction(Store $store)
    {
        $deleteForm = $this->createDeleteForm($store);

        return $this->render('store/show.html.twig', array(
            'store' => $store,
            'delete_form' => $deleteForm->createView(),
        ));
    }

}
