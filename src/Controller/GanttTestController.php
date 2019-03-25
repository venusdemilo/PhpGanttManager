<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class GanttTestController extends AbstractController
{
    /**
     * @Route("/gantt/test", name="gantt_test")
     */
    public function index()
    {


      $json = '{"name":"CS1","desc":"PR","values":[{"from":1320192000000,"to":1322401600000,"label":"CS1","desc":"Value Description 1","customClass":"custom-1","dataObj":{}}]},{"name":"Name 2","desc":"Description 2","values":[{"from":1320192000000,"to":1322401600000,"label":"Label 2","desc":"Value Description 2","customClass":"custom-2","dataObj":{}}]},{"name":"Name 3","desc":"Description 3","values":[{"from":1320192000000,"to":1322401600000,"label":"Label 3","desc":"Value Description 3","customClass":"custom-3","dataObj":{}}]}';


      $myData = [
  [
    'name' => 'CS1',
    'desc' => 'PL',
    'values' =>
    [

      array (
        'from' => 1320192000000,
        'to' => 1320102000000,
        'label' => 'CS1',
        'desc' => 'Value Description 1',
        'customClass' => 'custom-1',
        'dataObj' =>
        array (
        ),
      ),
    ],
  ],
  [
    'name' => 'Name 2',
    'desc' => 'Description 2',
    'values' =>
    [
      array (
        'from' => 1320192000000,
        'to' => 1322401600000,
        'label' => 'Label 2',
        'desc' => 'Value Description 2',
        'customClass' => 'custom-2',
        'dataObj' =>
        array ('nom' => 'coco',
        ),
      ),
    ],
  ],
  [
    'name' => 'Name 3',
    'desc' => 'Description 3',
    'values' =>
    [
      array (
        'from' => 1320192000000,
        'to' => 1322401600000,
        'label' => 'Label 3',
        'desc' => 'Value Description 3',
        'customClass' => 'custom-3',
        'dataObj' =>
        array (
        ),
      ),
    ],
  ],
];
    //  $myData = json_encode($myData);
  //  $jsondata = file_get_contents($json);
      $myJson = json_encode($myData  , true);
    //  print_r($myJson);
      if (null == $myJson)
      {
        echo json_last_error_msg();
      }



        return $this->render('gantt_test/index.html.twig', [
            'myData' => $json,
        ]);
    }
}
