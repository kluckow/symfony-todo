<?php

namespace AppBundle\Entity\Payment;

use Doctrine\ORM\Mapping as ORM;

/**
 * Payment
 *
 * @ORM\Table(name="payment")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PaymentRepository")
 */
class Payment
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="method", type="string", nullable=true)
     */
    private $method;

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $method
     * @return Payment
     */
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @var string
     * @ORM\Column(name="externalProviderPaymentStatus", type="string", nullable=true)
     */
    private $externalProviderPaymentStatus;

    /**
     * @return mixed
     */
    public function getExternalProviderPaymentStatus()
    {
        return $this->externalProviderPaymentStatus;
    }

    /**
     * @param mixed $externalProviderPaymentStatus
     * @return Payment
     */
    public function setExternalProviderPaymentStatus($externalProviderPaymentStatus)
    {
        $this->externalProviderPaymentStatus = $externalProviderPaymentStatus;
        return $this;
    }

    /**
     * @var \AppBundle\Entity\Order\MyOrder
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Order\MyOrder", inversedBy="payments", cascade={"persist"})
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $order;

    /**
     * @return \AppBundle\Entity\Order\MyOrder
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param \AppBundle\Entity\Order\MyOrder $order
     * @return Payment
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

