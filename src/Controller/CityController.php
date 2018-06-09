<?php
/**
 * Created by PhpStorm.
 * User: Manly
 * Date: 12/05/2018
 * Time: 12:18
 */

namespace App\Controller;

use App\Entity\City;
use App\Form\CityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CityController
 *
 * @Route("/{_locale}/city", name="city_", requirements={"_locale"="%app.locales%"})
 *
 * @author Manly AUSTRIE <austrie.manly@gmail.com>
 */
class CityController extends Controller
{
    /**
     * List of city
     *
     * @Route("/list", name="list")
     *
     * @author Manly AUSTRIE <austrie.manly@gmail.com>
     */
    public function cityList()
    {
        $cityRepo = $this->getDoctrine()->getRepository(City::class);
        return $this->render('city/list.html.twig', [
            'cities' => $cityRepo->findAll()
        ]);
    }

    /**
     * Edit city
     *
     * @Route("/edit/{id}", name="edit")
     *
     * @param Request $request
     * @param City $city
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @author Manly AUSTRIE <austrie.manly@gmail.com>
     */
    public function cityEdit(Request $request, City $city)
    {
        return $this->processCity($request, $city);
    }

    /**
     * Create city
     *
     * @Route("/new", name="new")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @author Manly AUSTRIE <austrie.manly@gmail.com>
     */
    public function cityNew(Request $request)
    {
        return $this->processCity($request, new City(), true);
    }

    /**
     * Delete city
     *
     * @Route("/delete/{id}", name="delete")
     *
     * @param City $city
     * @return Response
     *
     * @author Manly AUSTRIE <austrie.manly@gmail.com>
     */
    public function cityDelete(City $city)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($city);
        $entityManager->flush();

        $this->addFlash(
            'info',
            $this->get('translator')->trans('flashbag.notice.deleted')
        );

        return $this->redirectToRoute('city_list');
    }

    /**
     * Process city (edit or new)
     *
     * @param Request $request
     * @param City $city
     * @param bool $new
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     *
     * @author Manly AUSTRIE <austrie.manly@gmail.com>
     */
    private function processCity(Request $request, City $city, bool $new = false)
    {
        $entityManager = $this->getDoctrine()->getManager();

        // creation du formulaire
        $form = $this->createForm(CityType::class, $city, array(
            'new' => $new,
        ));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $city = $form->getData();
            $entityManager->persist($city);
            $entityManager->flush();

            $this->addFlash(
                'info',
                $this->get('translator')->trans('flashbag.notice.saved')
            );

            return $this->redirectToRoute('city_list');
        }

        $twigOpt['form'] = $form->createView();
        $twigOpt['new'] = $new;

        return $this->render('city/edit.html.twig', $twigOpt);
    }
}
