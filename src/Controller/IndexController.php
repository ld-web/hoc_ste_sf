<?php

namespace App\Controller;

use App\Entity\Newsletter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     * 
     * Méthode de page d'accueil
     */
    public function index(EntityManagerInterface $em)
    {
        //$em = $this->getDoctrine()->getManager();

        $newsletterItem = new Newsletter();
        $newsletterItem->setEmail('lucas@ld-web.net')
            ->setSubscribed(true);

        $em->persist($newsletterItem);
        $em->flush();

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
