<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Payment\Payment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Workflow controller.
 *
 * @Route("workflow")
 */
class WorkflowController extends Controller
{
    /**
     * @Route("/", name="workflow_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $payments = $em->getRepository('AppBundle\Entity\Payment\Payment')->findAll();

        $stateMachine = $this->get('state_machine.paypal');
        $transArr  = [];
        foreach ($payments as $payment) {
            $transitions['can_partial_refund'] = $stateMachine->can($payment, 'partial_refund');
            $transitions['can_additional_partial_refund'] = $stateMachine->can($payment, 'additional_partial_refund');
            $transitions['can_final_partial_refund'] = $stateMachine->can($payment, 'final_partial_refund');
            $transitions['can_complete_refund'] = $stateMachine->can($payment, 'complete_refund');
            $transArr[] = $transitions;
        }
        return $this->render('workflow/paypal.html.twig', array(
            'transitionArray' => $transArr,
        ));
    }

    /**
     * @param Payment $payment
     */
    public function getPossibleTransitions(Payment $payment) {
        $stateMachine = $this->get('state_machine.' . $payment->getMethod());
        $stateMachine->can($payment);
    }

}
