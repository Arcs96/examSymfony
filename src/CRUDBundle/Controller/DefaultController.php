<?php

namespace CRUDBundle\Controller;

use RuralBundle\Entity\Alojamiento;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{

  //Funcion que serializa un objeto alojamiento
  private function serializeAlojamiento(Alojamiento $alojamiento)
  {
    return array(
        'nombre' => $alojamiento->getNomAlojamiento(),
        'precio' => $alojamiento->getPrecioAprox(),
        'tipoAlquiler' => $alojamiento->getTipoAlquiler(),
        //'descripcion' => $alojamiento->getDescrip()
    );
  }

  /**
   * Lists all alojamiento entities.
   *
   * @Route("/", name="alojamiento_index")
   * @Method("GET")
   */
  public function indexAction()
  {
      $em = $this->getDoctrine()->getManager();

      $alojamientos = $em->getRepository('RuralBundle:Alojamiento')->findAll();

      return $this->render('crud/index.html.twig', array(
          'alojamientos' => $alojamientos,
      ));
  }

  /**
   * Creates a new alojamiento entity.
   *
   * @Route("/new", name="alojamiento_new")
   * @Method({"GET", "POST"})
   */
  public function newAction(Request $request)
  {
      $alojamiento = new Alojamiento();
      $form = $this->createForm('RuralBundle\Form\AlojamientoType', $alojamiento);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
          $em = $this->getDoctrine()->getManager();
          $em->persist($alojamiento);
          $em->flush();

          //return $this->redirectToRoute('alojamiento_show', array('id' => $alojamiento->getId()));
          $data['alojamiento'][] = $this->serializeAlojamiento($alojamiento);
          $response = new JsonResponse($data, 200);
          return $response;
      }

      return $this->render('crud/new.html.twig', array(
          'alojamiento' => $alojamiento,
          'form' => $form->createView(),
      ));
  }

  /**
   * Finds and displays a alojamiento entity.
   *
   * @Route("/{id}", name="alojamiento_show")
   * @Method("GET")
   */
  public function showAction(Alojamiento $alojamiento)
  {
      $deleteForm = $this->createDeleteForm($alojamiento);
      $response = new JsonResponse();

      //Devolvemos el alojamiento en JsonResponse
      $data['alojamiento'][] = $this->serializeAlojamiento($alojamiento);
      $response = new JsonResponse($data, 200);
      return $response;
  }

  /**
   * Displays a form to edit an existing alojamiento entity.
   *
   * @Route("/{id}/edit", name="alojamiento_edit")
   * @Method({"GET", "POST"})
   */
  public function editAction(Request $request, Alojamiento $alojamiento)
  {
      $deleteForm = $this->createDeleteForm($alojamiento);
      $editForm = $this->createForm('RuralBundle\Form\AlojamientoType', $alojamiento);
      $editForm->handleRequest($request);

      if ($editForm->isSubmitted() && $editForm->isValid()) {
          $this->getDoctrine()->getManager()->flush();

          //return $this->redirectToRoute('alojamiento_edit', array('id' => $alojamiento->getId()));
          $data['alojamiento'][] = $this->serializeAlojamiento($alojamiento);
          $response = new JsonResponse($data, 200);
          return $response;
      }

      return $this->render('crud/edit.html.twig', array(
          'alojamiento' => $alojamiento,
          'edit_form' => $editForm->createView(),
          'delete_form' => $deleteForm->createView(),
      ));
  }

  /**
   * Deletes a alojamiento entity.
   *
   * @Route("/{id}", name="alojamiento_delete")
   * @Method("DELETE")
   */
  public function deleteAction(Request $request, Alojamiento $alojamiento)
  {
      $form = $this->createDeleteForm($alojamiento);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
          $em = $this->getDoctrine()->getManager();
          $em->remove($alojamiento);
          $em->flush();

          $data['alojamiento'][] = $this->serializeAlojamiento($alojamiento);
          $response = new JsonResponse($data, 200);
      }

      return $response;
      //return $this->redirectToRoute('alojamiento_index');
  }

  /**
   * Creates a form to delete a alojamiento entity.
   *
   * @param Alojamiento $alojamiento The alojamiento entity
   *
   * @return \Symfony\Component\Form\Form The form
   */
  private function createDeleteForm(Alojamiento $alojamiento)
  {
      return $this->createFormBuilder()
          ->setAction($this->generateUrl('alojamiento_delete', array('id' => $alojamiento->getId())))
          ->setMethod('DELETE')
          ->getForm()
      ;
  }

}
