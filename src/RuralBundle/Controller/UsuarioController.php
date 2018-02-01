<?php

namespace RuralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use RuralBundle\Entity\User;
use RuralBundle\Form\UserType;

class UsuarioController extends Controller
{
  /**
   * @Route("/admin/usuariosView", name="usersView")
   */
  public function usuariosAction()
  {
      // Visualizar todo los usuarios
      $repository = $this->getDoctrine()->getRepository('RuralBundle:User');
      $usuario = $repository->findAll();

      return $this->render('RuralBundle:Default:usuarios.html.twig',array("usuarios"=>$usuario));
  }

  /**
   * @Route("/admin/updateUsuario/{id}", name="updateUsuario")
   */
  public function formUpdateAction(Request $request,$id)
  {
      // Actualizamos nombre de usuario y email
      $usuario = $this->getDoctrine()->getRepository('RuralBundle:User')->find($id);

      $form = $this->createForm(UserType::class,$usuario);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()){
        $em = $this->getDoctrine()->getManager();

        // Añadimos el role al usuario
        $role = ['ROLE_USER'];
        $usuario->setRoles($role);

        $em->persist($usuario);
        $em->flush();
        return $this->redirectToRoute('comarca');
      }
      return $this->render('RuralBundle:Default:form.html.twig',array("form"=>$form->createView()));
  }

  /**
   * @Route("/admin/deleteUsuario/{id}", name="deleteUsuario")
   */

 public function deleteAction($id)
 {
      // Eliminamos usuario mediante id
      $em = $this->getDoctrine()->getEntityManager();
      $usuarios = $em->getRepository("RuralBundle:User");

      $usuario = $usuarios->find($id);
      $em->remove($usuario);
      $flush=$em->flush();

      return $this->render('RuralBundle:Default:usuarios.html.twig',array("usuarios"=>$usuario));
  }
}
