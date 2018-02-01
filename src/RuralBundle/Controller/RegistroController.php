<?php

namespace RuralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use RuralBundle\Entity\User;
use RuralBundle\Form\UserType;

class RegistroController extends Controller
{

  /**
   * @Route("/register", name="user_registration")
   */
  public function registerAction(Request $request)
  {
      // 1) build the form
      $user = new User();
      $form = $this->createForm(UserType::class, $user);

      // 2) handle the submit (will only happen on POST)
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {

        // 3) Encode the password (you could also do this via Doctrine listener)
        $role = ['ROLE_USER'];
        $password = $this->get('security.password_encoder')
            ->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($password);
        $user->setRoles($role);

        // 4) save the User!
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        // ... do any other work - like sending them an email, etc
        // maybe set a "flash" success message for the user

        //return $this->redirectToRoute('replace_with_some_route');
      }

      return $this->render(
          'default/register.html.twig',
          array('form' => $form->createView())
      );
  }

}
