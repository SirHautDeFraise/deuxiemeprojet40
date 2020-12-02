<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\GestionContact;
use App\Entity\Contact;
use App\Form\ContactType;

/**
 * @Route("/contact", name="contact")
 */
class ContactController extends AbstractController {

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


      return $this->redirectToRoute("contact");
    }
    return $this->render('contact/contact.html.twig', [
                'form' => $form->createView(),
    ]);
  }

}
