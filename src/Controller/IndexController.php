<?php

namespace App\Controller;

use App\Repository\NewsletterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     * 
     * Méthode de page d'accueil
     */
    public function index(NewsletterRepository $newsletterRepository)
    {
        $newsletterItem = $newsletterRepository->createNewsletterItem(
            "lucas@ld-web.net"
        );

        return $this->render(
            'index/index.html.twig',
            ['newsletterItem' => $newsletterItem]
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
