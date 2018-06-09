<?php
/**
 * Created by PhpStorm.
 * User: Manly
 * Date: 12/05/2018
 * Time: 12:18
 */

namespace App\Controller;

use App\Entity\Station;
use App\Form\StationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class StationController
 *
 * @Route("/{_locale}/station", name="station_", requirements={"_locale"="%app.locales%"})
 *
 * @author Manly AUSTRIE <austrie.manly@gmail.com>
 */
class StationController extends Controller
{
    /**
     * List of station
     *
     * @Route("/list", name="list")
     *
     * @author Manly AUSTRIE <austrie.manly@gmail.com>
     */
    public function stationList()
    {
        $stationRepo = $this->getDoctrine()->getRepository(Station::class);
        return $this->render('station/list.html.twig', [
            'stations' => $stationRepo->findAll()
        ]);
    }

    /**
     * Edit station
     *
     * @Route("/edit/{id}", name="edit")
     *
     * @param Request $request
     * @param Station $station
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @author Manly AUSTRIE <austrie.manly@gmail.com>
     */
    public function stationEdit(Request $request, Station $station)
    {
        return $this->processStation($request, $station);
    }

    /**
     * Create station
     *
     * @Route("/new", name="new")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @author Manly AUSTRIE <austrie.manly@gmail.com>
     */
    public function stationNew(Request $request)
    {
        return $this->processStation($request, new Station(), true);
    }

    /**
     * Delete station
     *
     * @Route("/delete/{id}", name="delete")
     *
     * @param Station $station
     * @return Response
     *
     * @author Manly AUSTRIE <austrie.manly@gmail.com>
     */
    public function stationDelete(Station $station)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($station);
        $entityManager->flush();

        $this->addFlash(
            'info',
            $this->get('translator')->trans('flashbag.notice.deleted')
        );

        return $this->redirectToRoute('station_list');
    }

    /**
     * Process station (edit or new)
     *
     * @param Request $request
     * @param Station $station
     * @param bool $new
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     *
     * @author Manly AUSTRIE <austrie.manly@gmail.com>
     */
    private function processStation(Request $request, Station $station, bool $new = false)
    {
        $entityManager = $this->getDoctrine()->getManager();

        // creation du formulaire
        $form = $this->createForm(StationType::class, $station, array(
            'new' => $new,
        ));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $station = $form->getData();
            $entityManager->persist($station);
            $entityManager->flush();

            $this->addFlash(
                'info',
                $this->get('translator')->trans('flashbag.notice.saved')
            );

            return $this->redirectToRoute('station_list');
        }

        $twigOpt['form'] = $form->createView();
        $twigOpt['new'] = $new;

        return $this->render('station/edit.html.twig', $twigOpt);
    }
}
