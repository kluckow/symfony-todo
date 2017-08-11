<?php

namespace AppBundle\Entity\Order;

use AppBundle\Entity\Payment\PaymentStatus;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * MyOrder
 *
 * @ORM\Table(name="my_order")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MyOrderRepository")
 */
class MyOrder
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
     * @var float
     * @ORM\Column(type="decimal", scale=2)
     */
    private $brutto;

    /**
     * @var ArrayCollection|\AppBundle\Entity\Payment\Payment[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Payment\Payment", mappedBy="order", cascade={"persist"})
     */
    private $payments;

    /**
     * @var \AppBundle\Entity\Payment\PaymentStatus
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Payment\PaymentStatus")
     * @ORM\JoinColumn(name="payment_status_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $paymentStatus;

    /**
     * @return float
     */
    public function getBrutto()
    {
        return $this->brutto;
    }

    /**
     * @param float $brutto
     * @return MyOrder
     */
    public function setBrutto($brutto)
    {
        $this->brutto = $brutto;
        return $this;
    }

    /**
     * @return PaymentStatus
     */
    public function getPaymentStatus()
    {
        return $this->paymentStatus;
    }

    /**
     * @param PaymentStatus $paymentStatus
     * @return MyOrder
     */
    public function setPaymentStatus($paymentStatus)
    {
        $this->paymentStatus = $paymentStatus;
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

