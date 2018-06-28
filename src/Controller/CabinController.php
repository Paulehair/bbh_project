<?php

namespace App\Controller;

use App\Entity\Cabin;
use App\Form\CabinType;
use App\Repository\CabinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cabin")
 */
class CabinController extends Controller
{
    /**
     * @Route("/", name="cabin_index", methods="GET")
     */
    public function index(CabinRepository $cabinRepository): Response
    {
        return $this->render('cabin/index.html.twig', ['cabins' => $cabinRepository->findAll()]);
    }

    /**
     * @Route("/new", name="cabin_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $cabin = new Cabin();
        $form = $this->createForm(CabinType::class, $cabin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cabin);
            $em->flush();

            return $this->redirectToRoute('cabin_index');
        }

        return $this->render('cabin/new.html.twig', [
            'cabin' => $cabin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cabin_show", methods="GET")
     */
    public function show(Cabin $cabin): Response
    {
        return $this->render('cabin/show.html.twig', ['cabin' => $cabin]);
    }

    /**
     * @Route("/{id}/edit", name="cabin_edit", methods="GET|POST")
     */
    public function edit(Request $request, Cabin $cabin): Response
    {
        $form = $this->createForm(CabinType::class, $cabin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cabin_edit', ['id' => $cabin->getId()]);
        }

        return $this->render('cabin/edit.html.twig', [
            'cabin' => $cabin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cabin_delete", methods="DELETE")
     */
    public function delete(Request $request, Cabin $cabin): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cabin->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cabin);
            $em->flush();
        }

        return $this->redirectToRoute('cabin_index');
    }
}
