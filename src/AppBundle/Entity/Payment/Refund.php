<?php

namespace AppBundle\Entity\Payment;

use AppBundle\Entity\EntityInterface;
use AppBundle\Entity\Order\Order;
use AppBundle\Entity\Order\OrderReturn;
use AppBundle\Entity\Problem\Problem;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Refund
 *
 * @ORM\Table(name="refund")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RefundRepository")
 */
class Refund
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
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * Marking
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $refundStatus;


    public function __construct(\DateTime $createDate)
    {
        $this->createdAt = $createDate;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getRefundStatus()
    {
        return $this->refundStatus;
    }

    /**
     * @param string $refundStatus
     * @return Refund
     */
    public function setRefundStatus($refundStatus)
    {
        $this->refundStatus = $refundStatus;
        return $this;
    }

}