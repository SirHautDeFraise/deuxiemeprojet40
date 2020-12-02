<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController {

  /**
   * @Route("/contact", name="contact")
   */
  public function index(): Response {
    return $this->render('contact/index.html.twig', [
                'controller_name' => 'ContactController',
    ]);
  }

  /**
   * @Route("/contact", name="contact")
   */
  public function demandeContact(Request $request, GestionContact $gestionContact) {
    $contact = new Contact();
    $contact->setNom = "Dupont";
    $form = $this->createForm(ContactType::class, $contact);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {

      $this->addFlash('notification', "Votre message a bien été envoyé");
      $contact = $form->getData();
      $contact->setDatePremierContact(new \DateTime());
      $gestionContact->creerContact($contact);

      $gestionContact->envoiMailContact($contact);


      return $this->redirectToRoute("tutoriel");
    }
    return $this->render('tutoriel/contact.html.twig', [
                'form' => $form->createView(),
    ]);
  }

}
