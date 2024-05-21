<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="books")
 */
class Book
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
    private $title;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private $price;

    /**
     * @ORM\Column(type="string")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="Author", inversedBy="books")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="Publisher", inversedBy="books")
     * @ORM\JoinColumn(name="publisher_id", referencedColumnName="id")
     */
    private $publisher;


}
