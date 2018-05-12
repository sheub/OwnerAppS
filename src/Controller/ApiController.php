<?php
/**
 * Created by PhpStorm.
 * User: Manly
 * Date: 12/05/2018
 * Time: 13:50
 */

namespace App\Controller;


use App\Entity\City;
use App\Entity\Station;
use App\Repository\Doctrine\CityRepository;
use App\Repository\Doctrine\StationRepository;
use App\Service\NearService;
use App\WebService\Representation\CityRepresentation;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcherInterface;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Class ApiController
 *
 * @Route("/api", name="api_")
 *
 * @author Manly AUSTRIE <austrie.manly@gmail.com>
 */
class ApiController extends FOSRestController
{
    /**
     * Return list of cities
     *
     * @Rest\Get("/cities", name="city_list")
     *
     * @Rest\QueryParam(
     *     name="order",
     *     requirements="asc|desc",
     *     default="asc",
     *     description="Sort order (asc or desc)"
     * )
     * @Rest\QueryParam(
     *     name="limit",
     *     requirements="\d+",
     *     default="15",
     *     description="Max number of movies per page."
     * )
     * @Rest\QueryParam(
     *     name="page",
     *     requirements="\d+",
     *     default="1",
     *     description="The pagination page"
     * )
     * @Rest\View()
     *
     * @param ParamFetcherInterface $paramFetcher
     * @return CityRepresentation
     *
     * @author Manly AUSTRIE <austrie.manly@gmail.com>
     */
    public function ApiCityList(ParamFetcherInterface $paramFetcher)
    {
        /** @var CityRepository $cityRepository */
        $cityRepository = $this->getDoctrine()->getRepository(City::class);
        $pager = $cityRepository->search(
            $paramFetcher->get('order'),
            $paramFetcher->get('limit'),
            $paramFetcher->get('page')
        );

        return new CityRepresentation($pager);
    }

    /**
     * Get Stations near
     *
     * @Rest\Get("/stations/near", name="stations_near")
     *
     * @Rest\QueryParam(
     *     name="lat",
     *     requirements="^-?(?:\d+|\d*\.\d+)$",
     *     description="Max number of movies per page."
     * )
     * @Rest\QueryParam(
     *     name="lng",
     *     requirements="^-?(?:\d+|\d*\.\d+)$",
     *     description="Max number of movies per page."
     * )
     * @Rest\QueryParam(
     *     name="radius",
     *     requirements="\d+",
     *     default="0",
     *     description="The pagination page"
     * )
     * @Rest\View()
     *
     * @param ParamFetcherInterface $paramFetcher
     * @param NearService $nearService
     * @return CityRepresentation
     *
     * @author Manly AUSTRIE <austrie.manly@gmail.com>
     */
    public function ApiStationNear(ParamFetcherInterface $paramFetcher, NearService $nearService)
    {
        if (!$paramFetcher->get('lat') || !$paramFetcher->get('lng') || !$paramFetcher->get('radius')) {
            throw new \LogicException('$lat & $lng & $radius must be defined and must be numeric typpe.');
        }

        $resultNear = $nearService->getLatitudeLongitude(
            (float)$paramFetcher->get('lat'),
            (float)$paramFetcher->get('lng'),
            $paramFetcher->get('radius')
        );

        /** @var StationRepository $stationRepository */
        $stationRepository = $this->getDoctrine()->getRepository(Station::class);
        $stations = $stationRepository->getStationNear(
            $paramFetcher->get('lat'),
            $paramFetcher->get('lng'),
            $resultNear['lat'],
            $resultNear['lng']
        );

        return $stations;
    }
}