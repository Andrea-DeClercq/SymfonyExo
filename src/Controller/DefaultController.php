<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/default', name: 'app_default')]
    public function index(): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    /**
     * Route Annotations
     * @Route("/annotation/hello-world", name="annotations_route_hello")
     * @return void
     */
    public function helloAnnotation()
    {
        return new Response('<h1>Hello World</h1>');
    }
    /**
     * @Route("/annotation/hello-world/{slug}", 
     * name="annotations_route_hello_name")
     */
    public function helloAnnotationName(string $slug)
    {
        return new Response('<h1>Hello World' .$slug. '</h1>');
    }

    public function routeHello(){
        {
            return new Response('<h1>Hello World RouteYAML</h1>');
        }
    }
    public function routeHelloName(string $slug){
        {
            return new Response('<h1>Hello World '.$slug.' RouteYAML</h1>');
        }
    }
}
