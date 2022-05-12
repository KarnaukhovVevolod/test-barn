<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Entity\Departments;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Employee
 *
 * @ORM\Table(name="employee", indexes={@ORM\Index(name="fk_employee_birth", columns={"id_place_of_birth"})})
 * @ORM\Entity
 */
class Employee
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
     * @ORM\Column(name="surname", type="string", length=30)
     */
    private $surname;
    
    /**
     * @var string
     *
     * @ORM\Column(name="surname_eng", type="string", length=30)
     */
    private $surnameEng;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=30)
     */
    private $name;
    
    /**
     * @var string
     *
     * @ORM\Column(name="name_eng", type="string", length=30)
     */
    private $nameEng;
    
    /**
     * @var string
     *
     * @ORM\Column(name="patronymic", type="string", length=30)
     */
    private $patronymic;
    
    /**
     * @var string
     *
     * @ORM\Column(name="patronymic_eng", type="string", length=30)
     */
    private $patronymicEng;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var \Application\Entity\PlaceOfBirth
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\PlaceOfBirth")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_place_of_birth", referencedColumnName="id")
     * })
     */
    private $idPlaceOfBirth;
    
    /**
     * @ORM\ManyToMany(targetEntity="\Application\Entity\Departments", inversedBy="employee")
     * @ORM\JoinTable(name="empl_depart",
     *      joinColumns={@ORM\JoinColumn(name="id_employee", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_departments", referencedColumnName="id")}
     *      )
     */
    private $departament;
    
    
    public function __construct(){        
        $this->departament = new ArrayCollection();        
    }
    
    public function getDepartament(){
        return $this->departament;
    }
    
    public function addDepartament($departament){
        $this->departament[] = $departament;
        return $this;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getSurname(){
        return $this->surname;
    }
    
    public function setSurname($surname){
        $this->surname = $surname;
        return $this;
    }
    
    public function getSurnameEng(){
        return $this->surnameEng;
    }
    public function setSurnameEng($surnameEng){
        $this->surnameEng = $surnameEng;
        return $this;
    }
    
    public function getName(){
        return $this->name;
    }
    public function setName($name){
        $this->name = $name;
        return $this;
    }
    
    public function getNameEng(){
        return $this->nameEng;
    }
    public function setNameEng($nameEng){
        $this->nameEng = $nameEng;
        return $this;
    }
    
    public function getPatronymic(){
        return $this->patronymic;
    }
    
    public function setPatronymic($patronymic){
        $this->patronymic = $patronymic;
        return $this;
    }
    
    public function getPatronymicEng(){
        return $this->patronymicEng;
    }
    
    public function setPatronymicEng($patronymicEng){
        $this->patronymicEng = $patronymicEng;
        return $this;
    }
    
    public function setDate($date){
        $this->date = $date;
        return $this;
    }
    public function getDate(){
        return $this->date;
    }
    public function getIdPlaceOfBirth(){
        return $this->idPlaceOfBirth;
    }
    public function setIdPlaceOfBirth($idPlaceOfBirth){
        $this->idPlaceOfBirth = $idPlaceOfBirth;
    }
}
