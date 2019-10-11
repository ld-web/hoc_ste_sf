<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Form\NewsletterType;
use App\Repository\NewsletterRepository;
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
        EntityManagerInterface $em)
    {
        $newsletterItem = new Newsletter();
        $form = $this->createForm(NewsletterType::class, $newsletterItem);
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
    public function contact()
    {
        return $this->render('index/contact.html.twig');
    }
}
