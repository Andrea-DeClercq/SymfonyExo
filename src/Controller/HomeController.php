<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(EntityManagerInterface $em): Response
    {
        $listContact = $em->getRepository(Contact::class)->findAll();
        // dd($tableau);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'listContact' => $listContact,
        ]);
    }

    /**
     * Liste all contact
     * @Route("/liste", name="liste_contact")
     * @param EntityManagerInterface $em
     *
     */
    public function listeAllContact(EntityManagerInterface $em){
        {
            $listContact = $em->getRepository(Contact::class)->findAll();
            // dd($tableau);
            return $this->render('home/liste_contact.html.twig', [
                'controller_name' => 'HomeController',
                'listContact' => $listContact,
            ]);
        }
    }

    /**
     * Index Contact by ID
     *
     * @Route("/contact/{id}", name="contact_id") 
     * @param integer $id
     * @param EntityManagerInterface $em
     * @return Contact
     */
    public function indexBycontact(int $id, EntityManagerInterface $em){
        $contact = $em->getRepository(Contact::class)->find($id);
        // dd($contact);
        return $this->render('home/contact_detail.html.twig', [
            'name' => $contact->getName(),
            'lastname' => $contact->getLastName(),
            'phoneNumber' => $contact->getPhoneNumber(),
            'adress' => $contact->getAdresse(),
            'city' => $contact->getVille(),
            'age' => $contact->getAge()
        ]);
    }

    /**
     * Edit contact
     * @Route("/edit/{id}", name="edit_contact")
     * @param integer $id
     * @param EntityManagerInterface $em
     * 
     */
    public function editcontact(int $id, EntityManagerInterface $em, Request $request){
        $contact = $em->getRepository(Contact::class)->find($id);
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $em->persist($data);
            $em->flush($data);
            $this->addFlash(
                'notice',
                'Your changes were saved!'
            );
            // dd($data);
            return $this->redirectToRoute('app_home');
        }

        return $this->renderForm('home/form_contact.html.twig', [
            'form' => $form
        ]);
    }

    public function deleteContact(int $id, EntityManagerInterface $em){
        $contact = $em->getRepository(Contact::class)->find($id);

        if(!$contact)
        {
            throw $this->createNotFoundException('No Contact found');
        }
        $em->remove($contact);
        $em->flush();    
        return $this->redirectToRoute('app_home');
    }

    /**
     * Create Contact Form
     * @Route("/add", name="add_contact")
     * 
     */
    public function addContact(Request $request, EntityManagerInterface $em){

        $contact = new Contact();
               
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $em->persist($data);
            $em->flush($data);
            // dd($data);
            return $this->redirectToRoute('app_home');
        }
        return $this->renderForm('home/form_contact.html.twig', [
            'form' => $form
        ]);
    }
}
