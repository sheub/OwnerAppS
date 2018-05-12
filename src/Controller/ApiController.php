<?php
/**
 * Created by PhpStorm.
 * User: Manly
 * Date: 12/05/2018
 * Time: 13:50
 */

namespace App\Controller;


use App\Entity\City;
use App\Repository\Doctrine\CityRepository;
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
     * @Rest\Get("/cities", name="api_list")
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
}