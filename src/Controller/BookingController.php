<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\User;
use App\Form\BookingType;
use App\Repository\BookingRepository;
use App\Repository\CabinRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/booking")
 */
class BookingController extends Controller
{
    /** @
     * @Route("/", name="booking_index", methods="GET")
     */
    public function index(BookingRepository $bookingRepository): Response
    {
        return $this->render('booking/index.html.twig', ['bookings' => $bookingRepository->findAll()]);
    }

    /**
     * @Route("/new", name="booking_new", methods="GET|POST")
     */
    public function new(Request $request, ValidatorInterface $validator, CabinRepository $cabinRepository): Response
    {
        $booking = new Booking();
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        	$booking->setReference(uniqid());
        	$booking->setSessId($request->getSession()->getId());
            $em = $this->getDoctrine()->getManager();
            $em->persist($booking);
            $em->flush();
	        $request->getSession()->set('current', $booking->getId());
	        $request->getSession()->set('current_ref', $booking->getReference());

            return $this->redirectToRoute('login');
        }

        return $this->render('booking/new.html.twig', [
            'booking' => $booking,
            'form' => $form->createView(),
	        'cabin' => $cabinRepository->findAll()
        ]);
    }

    /**
     * @Route("/{id}", name="booking_show", methods="GET")
     */
    public function show(Request $request, int $id): Response
    {
    	$bookingRepository = $this->getDoctrine()->getManager()->getRepository('App:Booking');
	    $booking = $bookingRepository->findOneBy([
	    	'id' => $id
	    ]);
		if (is_null($booking)) {
			// @todo gerer la non existance du booking
			// return $this->render('booking/error.html.twig', []);
		}
        return $this->render('booking/show.html.twig', ['booking' => $booking]);
    }

    /**
     * @Route("/confirm_booking/", name="booking_show_by_ref", methods="GET")
     * @Security("has_role('ROLE_USER')")
     */
    public function showPostLogin(Request $request): Response
    {
	    $user = $this->getUser();
    	if (null === $user) {
		    throw new AccessDeniedException('nope');
	    }
    	$bookingRepository = $this->getDoctrine()->getManager()->getRepository('App:Booking');
	    $booking = $bookingRepository->findOneBy([
	    	'reference' => $request->getSession()->get('current_ref')
	    ]);
	    $booking->setUser($user);
		if (is_null($booking)) {
			// @todo gerer la non existance du booking
			// return $this->render('booking/error.html.twig', []);
		}

        return $this->render('booking/show.html.twig', ['booking' => $booking]);
    }

    /**
     * @Route("/{id}/edit", name="booking_edit", methods="GET|POST")
     */
    public function edit(Request $request, Booking $booking): Response
    {
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('booking_edit', ['id' => $booking->getId()]);
        }

        return $this->render('booking/edit.html.twig', [
            'booking' => $booking,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="booking_delete", methods="DELETE")
     */
    public function delete(Request $request, Booking $booking): Response
    {
        if ($this->isCsrfTokenValid('delete'.$booking->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($booking);
            $em->flush();
        }

        return $this->redirectToRoute('booking_index');
    }

	/**
	 * @Route("/{id}/edit", name="booking_edit", methods="GET|POST")
	 */
	public function addUser(Request $request, Booking $booking): Response
	{
		$form = $this->createForm(BookingType::class, $booking);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$this->getDoctrine()->getManager()->flush();

			return $this->redirectToRoute('booking_edit', ['id' => $booking->getId()]);
		}

		return $this->render('booking/edit.html.twig', [
			'booking' => $booking,
			'form' => $form->createView(),
		]);
	}
}

