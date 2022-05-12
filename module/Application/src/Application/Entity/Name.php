<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Name
 *
 * @ORM\Table(name="name")
 * @ORM\Entity
 */
class Name
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=21, nullable=false)
     */
    private $name;


}
