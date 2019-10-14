<?php

namespace App\Controller\Admin;

use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/", name="contact_index")
     * 
     * Si on tape "php bin/console debug:router",
     * On verra cette route avec l'URL "/admin/"
     * et le nom "admin_contact_index"
     * Pour plus d'explications, voir les fichiers :
     * config/routes/annotations.yaml
     * config/routes.yaml
     */
    public function index(ContactRepository $contactRepository)
    {
        $contacts = $contactRepository->findAll();

        return $this->render(
            'admin/contact/index.html.twig',
            ['contacts' => $contacts]
        );
    }
}
