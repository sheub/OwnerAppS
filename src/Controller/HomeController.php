<?php

namespace App\Controller;

use App\Entity\City;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends Controller
{
    /**
     * HomePage of app
     *
     * @Route("/", name="homepage")
     * @Route("/{_locale}", name="homepage_locale", requirements={"_locale"="%app.locales%"})
     *
     * @param Request $request
     * @return Response
     */
    public function home(Request $request)
    {
        return $this->render('homepage/_index.html.twig');
    }
}
