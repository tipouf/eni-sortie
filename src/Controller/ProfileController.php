<?php

namespace App\Controller;

use App\Entity\Contributor;
use App\Form\EditContributorType;
use App\Repository\ContributorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profil")
 */
class ProfileController extends AbstractController
{
  /**
   * @Route("/{contributor}", name="contributor_profil", methods={"GET"})
   */
  public function show(Contributor $contributor): Response
  {

    return $this->render('profile/profile.html.twig', [
      'contributor' => $contributor,
    ]);
  }

}
