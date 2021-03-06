<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/security", name="security")
     */
    public function index()
    {
        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }

	/**
	 * @Route("/login", name="login")
	 */
	public function loginAction(Request $request, AuthenticationUtils $authenticationUtils)
	{
		// get the login error if there is one
		$error = $authenticationUtils->getLastAuthenticationError();

		// last username entered by the user
		$lastUsername = $authenticationUtils->getLastUsername();
		return $this->render('security/login.html.twig', array(
			'last_username' => $lastUsername,
			'error'         => $error,
			'sessid'        => $request->getSession()->get('current'),
		));
	}

	/**
	 * @Route("/login_check", name="login_check")
	 */
	public function loginCheckAction(Request $request, Booking $booking, User $user)
	{
		// this controller will not be executed,
		// as the route is handled by the Security system
	}
}
