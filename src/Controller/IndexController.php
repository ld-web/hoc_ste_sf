<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Newsletter;
use App\Form\ContactSubmissionType;
use App\Form\NewsletterRegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     * 
     * Méthode de page d'accueil
     */
    public function index(
        Request $request,
        EntityManagerInterface $em
    ) {
        $newsletterItem = new Newsletter();
        $form = $this->createForm(NewsletterRegisterType::class, $newsletterItem);
        // En cas de requête POST, cette méthode va directement
        // mapper les données du formulaire dans l'objet transmis à createForm
        // Ici, l'objet est la variable $newsletterItem
        $form->handleRequest($request);

        // Donc si le formulaire a été soumis et est valide
        // On a déjà un objet prêt à être enregistré en BDD
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($newsletterItem);
            $em->flush();
        }

        return $this->render(
            'index/index.html.twig',
            [
                'newsletterItem' => $newsletterItem,
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/contact", name="contact")
     * 
     */
    public function contact(Request $request, EntityManagerInterface $em)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactSubmissionType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($contact);
            $em->flush();

            $this->addFlash(
                'success',
                'Merci, votre message a bien été enregistré'
            );
            return $this->redirectToRoute('homepage');
        } else {
            $this->addFlash(
                'info',
                'Merci de remplir le formulaire, votre demande sera enregistrée'
            );
        }

        return $this->render('index/contact.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
