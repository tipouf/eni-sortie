<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Route("/cities")
 */
class CityController extends AbstractController
{
  /**
   * @Route("/", name="main_cities", methods={"GET"})
   */
  public function main():Response
  {
    return $this->render('city/cities.html.twig');
  }

  /**
   * @Route("/edit/{city}", name="edit_city", methods={"POST"})
   */
  public function editCity():Response
  {
    return $this->render('city/edit_city.html.twig');
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