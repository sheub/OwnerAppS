<?php
/**
 * Created by PhpStorm.
 * User: Manly AUSTRIE <austrie.manly@gmail.com>
 * Date: 22/05/18
 * Time: 12:00
 */

namespace App\Handler;


use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class UserConnectionSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    protected $router;
    protected $container;

    public function __construct(RouterInterface $router, ContainerInterface $container)
    {
        $this->router = $router;
        $this->container = $container;
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @return RedirectResponse|Response
     * @throws \Exception
     *
     * @author Manly AUSTRIE <austrie.manly@gmail.com>
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $session = $request->getSession();

        // on met les locales du site en session
        $locales = $this->container->getParameter('app.locales');
        $session->set('siteLocales', explode('|', $locales));

        return new RedirectResponse($this->router->generate('homepage'));
    }
}