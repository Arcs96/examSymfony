<?php

namespace RuralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use RuralBundle\Entity\Alojamiento;
use RuralBundle\Form\AlojamientoType;

class RestController extends Controller
{

  /**
   * @Route("/mostrar/{id}",  methods="GET")
   */
  public function unicoAction($id)
  {
      $repository = $this->getDoctrine()->getRepository('RuralBundle:Alojamiento');
      $alojamiento = $repository->findById($id);

      return $this->render('RuralBundle:Default:aloj.html.twig',array("alojamientos"=>$alojamiento));
  }

  /**
   * @Route("/mostrarR/{nom}",  methods="GET")
   */
  public function unicoRAction($nom)
  {
      $repository = $this->getDoctrine()->getRepository('RuralBundle:Alojamiento');
      $alojamiento = $repository->findByNom_alojamiento($nom);

      return new Response('<html><head><body><h3>Bienvenido a '.$nom.'</h3></body></head></html>');
  }

}
