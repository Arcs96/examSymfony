<?php

namespace PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
  /**
   * @Route("/", name="home")
   */
  public function indexAction()
  {
      return $this->render('PrincipalBundle:Default:index.html.twig');
  }

  /**
   * @Route("/usuarios", name="usuarios")
   */
  public function usuariosAction()
  {
      return $this->render('PrincipalBundle:Default:index.html.twig');
  }

  /**
   * @Route("/nosotros", name="nosotros")
   */
  public function nosotrosAction()
  {
      return $this->render('PrincipalBundle:Default:nosotros.html.twig');
  }

  /**
   * @Route("/contacto", name="contacto")
   */
  public function contactoAction()
  {
      return $this->render('PrincipalBundle:Default:contacto.html.twig');
  }

  /**
   * @Route("/login", name="login")
   */
  public function loginAction(Request $request)
  {
    $authenticationUtils = $this->get('security.authentication_utils');

    // get the login error if there is one
    $error = $authenticationUtils->getLastAuthenticationError();

    // last username entered by the user
    $lastUsername = $authenticationUtils->getLastUsername();

    return $this->render('PrincipalBundle:Default:login.html.twig', array(
        'last_username' => $lastUsername,
        'error'         => $error,
    ));
  }

}
