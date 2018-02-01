<?php

namespace RuralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Propietarios
 *
 * @ORM\Table(name="propietarios")
 * @ORM\Entity(repositoryClass="RuralBundle\Repository\PropietariosRepository")
 */
class Propietarios
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
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
    * @ORM\ManyToOne(targetEntity="Alojamiento", inversedBy="propietarios")
    * @ORM\JoinColumn(name="alojamiento_id", referencedColumnName="id")
    */
   private $alojamiento;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Propietarios
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }
}
