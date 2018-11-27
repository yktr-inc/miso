<?php
namespace App\Controller\back;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return $this->render('back/index.html.twig');
    }
}
