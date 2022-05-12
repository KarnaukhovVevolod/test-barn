<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmplDepart
 *
 * @ORM\Table(name="empl_depart", indexes={@ORM\Index(name="fk_employee_depart", columns={"id_employee"}), @ORM\Index(name="fk_depart_employee", columns={"id_departments"})})
 * @ORM\Entity
 */
class EmplDepart
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
     * @var \Application\Entity\Departments
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Departments")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_departments", referencedColumnName="id")
     * })
     */
    private $idDepartments;

    /**
     * @var \Application\Entity\Employee
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Employee")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_employee", referencedColumnName="id")
     * })
     */
    private $idEmployee;


}
