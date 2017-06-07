<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Store;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class BackendController
 *
 * @Route ("backend")
 */
class BackendController extends Controller
{
    /**
     * Lists all store entities.
     *
     * @Route("/", name="backend_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->render('backend/index.html.twig');
    }

    /**
     * Lists all store entities.
     *
     * @Route("/store", name="backend_list_stores_index")
     * @Method("GET")
     */
    public function listStoresAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $stores = $em->getRepository('AppBundle:Store')->findAll();

        return $this->render("backend/store/index.html.twig", array(
            'stores' => $stores
        ));
    }

    /**
     * Creates a new store entity.
     *
     * @Route("/store/new", name="backend_new_store")
     * @Method({"GET", "POST"})
     */
    public function newStoreAction(Request $request)
    {
        $store = new Store();
        $form = $this->createForm('AppBundle\Form\StoreType', $store);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($store);
            $em->flush($store);

            return $this->redirectToRoute('backend_list_stores_index');
        }

        return $this->render('backend/store/new.html.twig', array(
            'store' => $store,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing store entity.
     *
     * @Route("/store/{id}/edit", name="backend_store_edit")
     * @Method({"GET", "POST"})
     */
    public function editStoreAction(Request $request, Store $store)
    {
        $deleteForm = $this->createDeleteStoreForm($store);
        $editForm = $this->createForm('AppBundle\Form\StoreType', $store);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('backend_list_stores_index');
        }

        return $this->render('store/edit.html.twig', array(
            'store' => $store,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a store entity.
     *
     * @Route("/store/{id}", name="backend_store_delete")
     * @Method("DELETE")
     */
    public function deleteStoreAction(Request $request, Store $store)
    {
        $form = $this->createDeleteStoreForm($store);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($store);
            $em->flush($store);
        }

        return $this->redirectToRoute('backend_list_stores_index');
    }

    /**
     * Creates a form to delete a store entity.
     *
     * @param Store $store The store entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteStoreForm(Store $store)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('backend_store_delete', array('id' => $store->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

}
