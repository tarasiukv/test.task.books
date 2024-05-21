<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="publishers")
 */
class Publisher
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity="Book", mappedBy="publisher")
     */
    private $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

}
