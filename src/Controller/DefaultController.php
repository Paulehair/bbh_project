<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
	public function index()
	{
		return new Response("Hello");
	}

	/**
	 * @Route("/admin")
	 */
	public function admin()
	{
		return new Response('<html><body>Admin page!</body></html>');
	}
}
