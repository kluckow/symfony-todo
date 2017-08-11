<?php

// /src/AppBundle/Event/Subscriber/CustomerSignUpGuard.php

namespace AppBundle\Event\Subscriber;

use AppBundle\Entity\PaymentStatus;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Workflow\Event\GuardEvent;
use Symfony\Component\Workflow\Exception\LogicException;

class PayPalGuard implements EventSubscriberInterface
{
    public function guardTest(GuardEvent $event)
    {
        /**
         * @var $paymentStatus PaymentStatus
         */
        $paymentStatus = $event->getSubject();

        $orderRefunds = 10;
        $orderPayments = 10;

        if ($orderRefunds >= $orderPayments) {
            $event->setBlocked('true');
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            // workflow.[workflow name].guard.[transition name]
            'workflow.paypal.guard.additional_partial_refund' => 'guardTest'
        ];
    }
}