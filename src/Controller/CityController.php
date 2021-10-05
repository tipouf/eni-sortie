<?php

namespace App\Controller;

use App\Form\CityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\CityRepository;


/**
 * @Route("/cities")
 */
class CityController extends AbstractController
{
  /**
   * @Route("/", name="main_cities", methods={"GET"})
   */
  public function main(CityRepository $cityRepository):Response
  {
    return $this->render('city/cities.html.twig', [
      'cities' => $cityRepository->findAll(),
    ]);
  }

  /**
   * @Route("/edit/{city}", name="edit_city", methods={"GET","POST"})
   */
  public function editCity():Response
  {
    $form = $this->createForm(CityType::class, $city);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $this->getDoctrine()->getManager()->flush();

      return $this->redirectToRoute('city_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->renderForm('city/edit_city.html.twig', [
      'city' => $city,
      'form' => $form,
    ]);
  }

  /**
   * @Route("/search", name="search_city", methods={"GET"})
   */
  public function searchCity():Response
  {
    return $this->render('city/search_city.html.twig');
  }

  /**
   * @Route("/delete/{city}", name="delete_city", methods={"POST"})
   */
  public function deleteCity():Response
  {
    return response('DELETE', 200);
  }

  /**
   * @Route("/add", name="add_city", methods={"POST"})
   */
  public function addCity():Response
  {
    return $this->render('city/add_city.html.twig');
  }
}