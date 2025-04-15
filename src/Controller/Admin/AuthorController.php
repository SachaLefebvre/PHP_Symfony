<?php

namespace App\Controller\Admin;

use App\Entity\Author;
use App\Form\AuthorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface; 

#[Route('/admin/author', name: 'app_admin_author')]
final class AuthorController extends AbstractController{
    #[Route('/', name: '_index')]
    public function index(): Response
    {
        return $this->render('admin/author/index.html.twig', [
            'controller_name' => 'Admin/AuthorController',
        ]);
    }

    #[Route('/new', name: '_new', methods: ['GET','POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $author = new Author();
        $form = $this->createForm(AuthorType::class, $author);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) { 
            $em -> persist($author); 
            $em -> flush();
            return $this-> redirectToRoute('app_admin_author_new');
        }

        return $this->render('admin/author/new.html.twig', [
            'form' => $form,
        ]);
    }
}
