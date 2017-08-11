<?php

namespace AppBundle\Entity\Payment;

use Doctrine\ORM\Mapping as ORM;

/**
 * PaymentStatus
 *
 * @ORM\Table(name="payment_status")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PaymentStatusRepository")
 */
class PaymentStatus
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
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return PaymentStatus
     */
    public function setName($name)
    {
        $this->name = $name;
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

