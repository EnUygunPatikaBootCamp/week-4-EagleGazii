<?php

namespace App\Controller;

use \Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ViewController extends AbstractController
{


    /**
     * @Route("/home", name="home_page")
     */
    public function homePage(): Response {
        $jokes = getRandomJokes(5);
        return $this->render('homepage.html.twig',[
            'jokes'=> $jokes,
            'today'=> $date = date('m/d/Y h:i:s a', time())
        ]);
    }
}