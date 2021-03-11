<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $contactFormData = $form->getData();

            $email = (new Email())
                ->from($contactFormData['from'])
                ->to('patrick.croquet@afpa.fr')
                ->subject('Time for Symfony Mailer!')
                ->text($contactFormData['message']);

            $mailer->send($email);

            $this->addFlash('success', 'Votre message a été envoyé !');

            return $this->redirectToRoute('contact');
        }    

        return $this->render('contact/index.html.twig', [
            'contact_form' => $form->createView()
        ]);
    }
}
