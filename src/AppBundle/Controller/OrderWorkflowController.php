<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Order Workflow Controller
 *
 * @Route("workflow")
 */
class OrderWorkflowController extends Controller
{
    /**
     * Show order payment status workflow.
     *
     * @Route("/order_paymentstatus", name="order_payment_status")
     * @Method("GET")
     */
    public function workflowOrderPaymentStatusAction()
    {
        return $this->render('order_payment_status/doc.svg.twig');
    }

    /**
     * Show order refund status workflow.
     *
     * @Route("/order_refund_status", name="order_refund_status")
     * @Method("GET")
     */
    public function workflowOrderRefundStatusAction()
    {
        return $this->render('order_refund_status/doc.svg.twig');
    }

}
