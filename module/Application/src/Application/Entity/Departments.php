<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Entity\Employee;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Departments
 *
 * @ORM\Table(name="departments")
 * @ORM\Entity
 */
class Departments
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
     * @ORM\Column(name="department_name", type="string", length=256, nullable=false)
     */
    private $departmentName;
    
    /**
     * @ORM\ManyToMany(targetEntity="\Application\Entity\Employee", mappedBy="departament")
     * @ORM\JoinTable(name="empl_depart",
     *      joinColumns={@ORM\JoinColumn(name="id_employee", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_departments", referencedColumnName="id")}
     *      )
     */
    private $employee;
    
    public function __construct(){        
        $this->employee = new ArrayCollection();        
    }
    
    public function getEmployee(){
        return $this->employee;
    }
    
    public function addEmployee($employee){
        $this->employee[] = $employee;
        return $this;
    }
    
    public function getId(){
        return $this->id;
    }
    public function getDepartmentName(){
        return $this->departmentName;
    }
    public function setDepartmentName($departmentName){
        $this->departmentName = $departmentName;
        return $this;
    }
}
