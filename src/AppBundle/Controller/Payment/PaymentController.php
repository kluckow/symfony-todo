<?php

namespace AppBundle\Controller\Payment;

use AppBundle\Entity\Payment\Payment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Payment controller.
 *
 * @Route("payment_payment")
 */
class PaymentController extends Controller
{
    /**
     * Lists all payment entities.
     *
     * @Route("/", name="payment_payment_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $payments = $em->getRepository('AppBundle:Payment\Payment')->findAll();

        return $this->render('payment/payment/index.html.twig', array(
            'payments' => $payments,
        ));
    }

    /**
     * Creates a new payment entity.
     *
     * @Route("/new", name="payment_payment_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $payment = new Payment();
        $form = $this->createForm('AppBundle\Form\Payment\PaymentType', $payment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($payment);
            $em->flush($payment);

            return $this->redirectToRoute('payment_payment_show', array('id' => $payment->getId()));
        }

        return $this->render('payment/payment/new.html.twig', array(
            'payment' => $payment,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a payment entity.
     *
     * @Route("/{id}", name="payment_payment_show")
     * @Method("GET")
     */
    public function showAction(Payment $payment)
    {
        $deleteForm = $this->createDeleteForm($payment);

        return $this->render('payment/payment/show.html.twig', array(
            'payment' => $payment,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing payment entity.
     *
     * @Route("/{id}/edit", name="payment_payment_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Payment $payment)
    {
        $deleteForm = $this->createDeleteForm($payment);
        $editForm = $this->createForm('AppBundle\Form\Payment\PaymentType', $payment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('payment_payment_edit', array('id' => $payment->getId()));
        }

        return $this->render('payment/payment/edit.html.twig', array(
            'payment' => $payment,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a payment entity.
     *
     * @Route("/{id}", name="payment_payment_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Payment $payment)
    {
        $form = $this->createDeleteForm($payment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($payment);
            $em->flush($payment);
        }

        return $this->redirectToRoute('payment_payment_index');
    }

    /**
     * Creates a form to delete a payment entity.
     *
     * @param Payment $payment The payment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Payment $payment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('payment_payment_delete', array('id' => $payment->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
