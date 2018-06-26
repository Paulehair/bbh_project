<?php

namespace App\Controller;

use App\Entity\Activities;
use App\Form\ActivitiesType;
use App\Repository\ActivitiesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/activities")
 */
class ActivitiesController extends Controller
{
    /**
     * @Route("/", name="activities_index", methods="GET")
     */
    public function index(ActivitiesRepository $activitiesRepository): Response
    {
        return $this->render('activities/index.html.twig', ['activities' => $activitiesRepository->findAll()]);
    }

    /**
     * @Route("/new", name="activities_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $activity = new Activities();
        $form = $this->createForm(ActivitiesType::class, $activity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($activity);
            $em->flush();

            return $this->redirectToRoute('activities_index');
        }

        return $this->render('activities/new.html.twig', [
            'activity' => $activity,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="activities_show", methods="GET")
     */
    public function show(Activities $activity): Response
    {
        return $this->render('activities/show.html.twig', ['activity' => $activity]);
    }

    /**
     * @Route("/{id}/edit", name="activities_edit", methods="GET|POST")
     */
    public function edit(Request $request, Activities $activity): Response
    {
        $form = $this->createForm(ActivitiesType::class, $activity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('activities_edit', ['id' => $activity->getId()]);
        }

        return $this->render('activities/edit.html.twig', [
            'activity' => $activity,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="activities_delete", methods="DELETE")
     */
    public function delete(Request $request, Activities $activity): Response
    {
        if ($this->isCsrfTokenValid('delete'.$activity->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($activity);
            $em->flush();
        }

        return $this->redirectToRoute('activities_index');
    }
}
