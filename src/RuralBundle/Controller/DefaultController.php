<?php

namespace RuralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use RuralBundle\Entity\Alojamiento;
use RuralBundle\Form\AlojamientoType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

  /**
   * @Route("/home_rural", name="rural")
   */
  public function indexAction()
  {
      return $this->render('RuralBundle:Default:index.html.twig');
  }

  /**
   * @Route("/prueba", name="prueba")
   */
  public function pruebaAction()
  {
      return $this->render('RuralBundle:Default:index.html.twig');
  }

  /**
   * @Route("/comarca", name="comarca")
   */
  public function comarcaAction()
  {
      $repository = $this->getDoctrine()->getRepository('RuralBundle:Alojamiento');
      $alojamiento = $repository->findAll();

      return $this->render('RuralBundle:Default:comarca.html.twig',array("alojamientos"=>$alojamiento));
  }

  /**
   * @Route("/admin/forminsert", name="forminsert")
   */
  public function formAction(Request $request)
  {
      $alojamiento = new Alojamiento();
      $form = $this->createForm(AlojamientoType::class);

      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
        // $form->getData() holds the submitted values
        // but, the original `$task` variable has also been updated
        $alojamiento = $form->getData();

        // ... perform some action, such as saving the task to the database
        // for example, if Task is a Doctrine entity, save it!
        $em = $this->getDoctrine()->getManager();
        $em->persist($alojamiento);
        $em->flush();

        return $this->redirectToRoute('comarca');
    }
    return $this->render('RuralBundle:Default:form.html.twig',array("form"=>$form->createView()));
  }

  /**
   * @Route("/admin/formupdate/{id}", name="formupdate")
   */
  public function formUpdateAction(Request $request,$id)
  {
      $alojamiento = $this->getDoctrine()->getRepository('RuralBundle:Alojamiento')->find($id);

      $form = $this->createForm(AlojamientoType::class,$alojamiento);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()){
        $em = $this->getDoctrine()->getManager();
        $em->persist($alojamiento);
        $em->flush();
        return $this->redirectToRoute('comarca');
      }
      return $this->render('RuralBundle:Default:form.html.twig',array("form"=>$form->createView()));
  }

  /**
   * @Route("/admin/formdelete/{id}", name="formdelete")
   */

 public function editAction($id)
 {
      $em = $this->getDoctrine()->getEntityManager();
      $alojamientos = $em->getRepository("RuralBundle:Alojamiento");

      $alojamiento = $alojamientos->find($id);
      $em->remove($alojamiento);
      $flush=$em->flush();

      if ($flush == null) {
          echo "Post se ha borrado correctamente";
      } else {
          echo "El post no se ha borrado";
      }
      return $this->render('RuralBundle:Default:comarca.html.twig',array("alojamientos"=>$alojamiento));
  }

  /**
   * @Route("/alojamiento/{nom}", name="alojamiento")
   */
  public function alojamientoAction($nom)
  {
      $repository = $this->getDoctrine()->getRepository('RuralBundle:Alojamiento');
      $alojamiento = $repository->findByNom_alojamiento($nom);
      return $this->render('RuralBundle:Default:alojamiento.html.twig',array("alojamientos"=>$alojamiento));
  }

}
