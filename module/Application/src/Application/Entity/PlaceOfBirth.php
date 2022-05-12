<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlaceOfBirth
 *
 * @ORM\Table(name="place_of_birth")
 * @ORM\Entity
 */
class PlaceOfBirth
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
     * @ORM\Column(name="place_of_birth", type="string", length=1024, nullable=false)
     */
    private $placeOfBirth;
    
    public function setPlaceOfBirth($placeOfBirth){
        $this->placeOfBirth = $placeOfBirth;
        return $this;
    }
    
    public function getId(){
        return $this->id;
        
    }
    public function getPlaceOfBirth(){
        return $this->placeOfBirth;
    }

}
