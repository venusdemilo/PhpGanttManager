<?php

namespace App\Controller;

use App\Entity\GanttData;
use App\Form\GanttDataType;
use App\Repository\GanttDataRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gantt/data")
 */
class GanttDataController extends AbstractController
{
    /**
     * @Route("/", name="gantt_data_index", methods={"GET"})
     */
    public function index(GanttDataRepository $ganttDataRepository): Response
    {
        return $this->render('gantt_data/index.html.twig', [
            'gantt_datas' => $ganttDataRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="gantt_data_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ganttDatum = new GanttData();
        $form = $this->createForm(GanttDataType::class, $ganttDatum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ganttDatum);
            $entityManager->flush();

            return $this->redirectToRoute('gantt_data_index');
        }

        return $this->render('gantt_data/new.html.twig', [
            'gantt_datum' => $ganttDatum,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="gantt_data_show", methods={"GET"})
     */
    public function show(GanttData $ganttDatum): Response
    {
        return $this->render('gantt_data/show.html.twig', [
            'gantt_datum' => $ganttDatum,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="gantt_data_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, GanttData $ganttDatum): Response
    {
        $form = $this->createForm(GanttDataType::class, $ganttDatum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gantt_data_index', [
                'id' => $ganttDatum->getId(),
            ]);
        }

        return $this->render('gantt_data/edit.html.twig', [
            'gantt_datum' => $ganttDatum,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="gantt_data_delete", methods={"DELETE"})
     */
    public function delete(Request $request, GanttData $ganttDatum): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ganttDatum->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ganttDatum);
            $entityManager->flush();
        }

        return $this->redirectToRoute('gantt_data_index');
    }
}
