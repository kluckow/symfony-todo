<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Payment\PaymentStatus;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Paymentstatus controller.
 *
 * @Route("paymentstatus")
 */
class PaymentStatusController extends Controller
{
    /**
     * Show billpay workflow.
     *
     * @Route("/workflow/billpay", name="workflow_billpay")
     * @Method("GET")
     */
    public function workflowGraphvizBillpayAction()
    {
        $em = $this->getDoctrine()->getManager();

        $paymentStatuses = $em->getRepository('AppBundle:Payment\PaymentStatus')->findAll();

        return $this->render('billpay/doc.svg.twig');
    }

    /**
     * Show klarna workflow.
     *
     * @Route("/workflow/klarna", name="workflow_klarna")
     * @Method("GET")
     */
    public function workflowGraphvizKlarnaAction()
    {
        $em = $this->getDoctrine()->getManager();

        $paymentStatuses = $em->getRepository('AppBundle:Payment\PaymentStatus')->findAll();

        return $this->render('klarna/doc.svg.twig');
    }

    /**
     * Show paypal workflow.
     *
     * @Route("/workflow/paypal", name="workflow_paypal")
     * @Method("GET")
     */
    public function workflowGraphvizPaypalAction()
    {
        return $this->render('paypal/doc.svg.twig');
    }

}
