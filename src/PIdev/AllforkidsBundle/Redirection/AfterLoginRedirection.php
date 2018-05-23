<?php
/**
 * Created by PhpStorm.
 * User: Lauris
 * Date: 06/02/2018
 * Time: 10:48
 */

namespace PIdev\AllforkidsBundle\Redirection;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class AfterLoginRedirection implements AuthenticationSuccessHandlerInterface
{
    /**
     * @var \Symfony\Component\Routing\RouterInterface
     */
    private $router;

    /**
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @return RedirectResponse
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        // Get list of roles for current user
        $roles = $token->getRoles();
        // Tranform this list in array
        $rolesTab = array_map(function ($role) {
            return $role->getRole();
        }, $roles);
        // If is a admin or super admin we redirect to the backoffice area
        if (in_array('ROLE_ADMIN', $rolesTab, true))
            $redirection = new RedirectResponse($this->router->generate('Admin_Home_Page'));
        // otherwise, if is a commercial user we redirect to the crm area
        elseif (in_array('ROLE_MEDECIN', $rolesTab, true))
            $redirection = new RedirectResponse($this->router->generate('Home_Page'));
        // otherwise, if is a commercial user we redirect to the crm area
        elseif (in_array('ROLE_RESPONSABLE_ASSOCIATION', $rolesTab, true))
            $redirection = new RedirectResponse($this->router->generate('Home_Page'));
        // otherwise, if is a commercial user we redirect to the crm area
        elseif (in_array('ROLE_RESPONSABLE_CLUB', $rolesTab, true))
            $redirection = new RedirectResponse($this->router->generate('Home_Page'));
        else
            $redirection = new RedirectResponse($this->router->generate('Home_Page'));

        return $redirection;
    }
}