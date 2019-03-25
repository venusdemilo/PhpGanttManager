<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\GanttDataRepository;
use App\Entity\GanttData;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class JsonController extends AbstractController
{
    /**
     * @Route("/json/{id}", name="json_id")
     */
    public function index($id)
    {
      $ganttData= $this->getDoctrine()->getRepository(GanttData::class)->find($id);
      if (!$ganttData) {

$json = [   [
  'name' => 'exemple',
   'desc' => 'Lorem ipsum dolor sit amet.',
   'values' => [[
                'to' => 1328832000000,
                'from'=>1333411200000,
                'desc'=>'quelque chose',
                'label'=>'Valeur exemple',
                'customClass'=>'ganttRed',
                'dataObj'=>[]
                ]]
            ],
            [
              'name' => 'exemple',
               'desc' => 'Lorem ipsum dolor sit amet.',
               'values' => [[
                            'to' => 1328832000000,
                            'from'=>1333411200000,
                            'desc'=>'quelque chose',
                            'label'=>'Valeur exemple',
                            'customClass'=>'ganttRed',
                            'dataObj'=>[]
                            ]]
            ]
];
      }
else
      {$json = $ganttData->getGanttJson();}
      $response = new JsonResponse($json);
      return $response;

    }

    /**
    * @Route("/json/{id}/update", name="json_id_update")
    */

    public function update(Request $request, $id)
    {
      $em = $this->getDoctrine()->getManager();
      $ganttData= $em->getRepository(GanttData::class)->find($id);
      $ganttData->setGanttJson(json_decode($request->request->get('objet')));
      $em->flush();
    }
}
