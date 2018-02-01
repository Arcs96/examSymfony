<?php

namespace RuralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Alojamiento
 *
 * @ORM\Table(name="alojamiento")
 * @ORM\Entity(repositoryClass="RuralBundle\Repository\AlojamientoRepository")
 */
class Alojamiento
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
     * @ORM\Column(name="nom_alojamiento", type="string", length=255)
     */
    private $nomAlojamiento;

    /**
     * @var int
     *
     * @ORM\Column(name="precio_aprox", type="integer")
     */
    private $precioAprox;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_alquiler", type="string", length=255)
     */
    private $tipoAlquiler;

    /**
     * @var string
     *
     * @ORM\Column(name="descrip", type="string", length=255)
     */
    private $descrip;

    /**
     * @var int
     *
     * @ORM\Column(name="num_estancia", type="integer")
     */
    private $numEstancia;

    /**
     * @var int
     *
     * @ORM\Column(name="num_pers", type="integer")
     */
    private $numPers;

    /**
     * @var string
     *
     * @ORM\Column(name="servicios", type="string", length=255)
     */
    private $servicios;

    /**
     * @ORM\OneToMany(targetEntity="Propietarios", mappedBy="alojamiento")
     */
    private $propietarios;

    /*public function __toString()
    {
        return $this->foo;
    }*/

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
     * Set nomAlojamiento
     *
     * @param string $nomAlojamiento
     *
     * @return Alojamiento
     */
    public function setNomAlojamiento($nomAlojamiento)
    {
        $this->nomAlojamiento = $nomAlojamiento;

        return $this;
    }

    /**
     * Get nomAlojamiento
     *
     * @return string
     */
    public function getNomAlojamiento()
    {
        return $this->nomAlojamiento;
    }

    /**
     * Set precioAprox
     *
     * @param integer $precioAprox
     *
     * @return Alojamiento
     */
    public function setPrecioAprox($precioAprox)
    {
        $this->precioAprox = $precioAprox;

        return $this;
    }

    /**
     * Get precioAprox
     *
     * @return int
     */
    public function getPrecioAprox()
    {
        return $this->precioAprox;
    }

    /**
     * Set tipoAlquiler
     *
     * @param string $tipoAlquiler
     *
     * @return Alojamiento
     */
    public function setTipoAlquiler($tipoAlquiler)
    {
        $this->tipoAlquiler = $tipoAlquiler;

        return $this;
    }

    /**
     * Get tipoAlquiler
     *
     * @return string
     */
    public function getTipoAlquiler()
    {
        return $this->tipoAlquiler;
    }

    /**
     * Set descrip
     *
     * @param string $descrip
     *
     * @return Alojamiento
     */
    public function setDescrip($descrip)
    {
        $this->descrip = $descrip;

        return $this;
    }

    /**
     * Get descrip
     *
     * @return string
     */
    public function getDescrip()
    {
        return $this->descrip;
    }

    /**
     * Set numEstancia
     *
     * @param integer $numEstancia
     *
     * @return Alojamiento
     */
    public function setNumEstancia($numEstancia)
    {
        $this->numEstancia = $numEstancia;

        return $this;
    }

    /**
     * Get numEstancia
     *
     * @return int
     */
    public function getNumEstancia()
    {
        return $this->numEstancia;
    }

    /**
     * Set numPers
     *
     * @param integer $numPers
     *
     * @return Alojamiento
     */
    public function setNumPers($numPers)
    {
        $this->numPers = $numPers;

        return $this;
    }

    /**
     * Get numPers
     *
     * @return int
     */
    public function getNumPers()
    {
        return $this->numPers;
    }

    /**
     * Set servicios
     *
     * @param string $servicios
     *
     * @return Alojamiento
     */
    public function setServicios($servicios)
    {
        $this->servicios = $servicios;

        return $this;
    }

    /**
     * Get servicios
     *
     * @return string
     */
    public function getServicios()
    {
        return $this->servicios;
    }
}
