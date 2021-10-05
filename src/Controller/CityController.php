<?php

namespace App\Controller;

use App\Form\CityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CityRepository;
use App\Entity\City;

/**
 * @Route("/cities")
 */
class CityController extends AbstractController
{
  /**
   * @Route("/", name="main_cities")
   */
  public function main(CityRepository $cityRepository):Response
  {
    return $this->render("city/cities.html.twig",[
      'cities' => $cityRepository->findAll(),
    ]);
  }
  /**
   * @Route("/edit/{city}", name="edit_city", methods={"GET","POST"})
   */
  public function editCity(Request $request, City $city):Response
  {
    $form = $this->createForm(CityType::class, $city);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $this->getDoctrine()->getManager()->flush();

      return $this->redirectToRoute('main_cities', [], Response::HTTP_SEE_OTHER);
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
   * @Route("/delete/{city}", name="delete_city", methods={"GET","POST"})
   */
  public function deleteCity(Request $request, City $city):Response
  {
    if ($this->isCsrfTokenValid('delete'.$city->getId(), $request->request->get('_token'))) {
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->remove($city);
      $entityManager->flush();
    }

    return $this->redirectToRoute('main_cities', [], Response::HTTP_SEE_OTHER);
  }

  /**
   * @Route("/add", name="add_city", methods={"GET", "POST"})
   */
  public function addCity(Request $request):Response
  {
    $city = new City();
    $form = $this->createForm(CityType::class, $city);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($city);
      $entityManager->flush();

      return $this->redirectToRoute('main_cities', [], Response::HTTP_SEE_OTHER);
    }

    return $this->renderForm('city/add_city.html.twig', [
      'city' => $city,
      'form' => $form,
    ]);
  }
}