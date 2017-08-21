<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Payment\PaymentStatus;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Refundstatus controller.
 *
 * @Route("refundstatus")
 */
class RefundStatusController extends Controller
{
    /**
     * Show refund workflow.
     *
     * @Route("/workflow", name="workflow")
     * @Method("GET")
     */
    public function workflowAction()
    {
        return $this->render('refund/doc.svg.twig');
    }

}
