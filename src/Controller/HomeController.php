<?php
/**
 * Created by PhpStorm.
 * User: Manly
 * Date: 12/05/2018
 * Time: 12:08
 */

namespace App\Controller;


use App\Entity\City;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class HomeController
 * @package App\Controller
 *
 * @author Manly AUSTRIE <austrie.manly@gmail.com>
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
     *
     * @author Manly AUSTRIE <austrie.manly@gmail.com>
     */
    public function home(Request $request)
    {
        $cityRepo = $this->getDoctrine()->getRepository(City::class);
        return $this->render('homepage/_index.html.twig',[
            'cities' => $cityRepo->findAll()
        ]);
    }
}