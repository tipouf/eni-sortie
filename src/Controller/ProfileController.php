<?php

namespace App\Controller;

use App\Entity\Contributor;
use App\Form\EditContributorType;
use App\Repository\ContributorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
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
  /**
   * @Route("/{contributor}/edit", name="contributor_edit", methods={"GET", "POST"})
   */
  public function edit(Request $request, Contributor $contributor,  UserPasswordHasherInterface $hasher): Response
  {
    $form = $this->createForm(EditContributorType::class, $contributor);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $hash = $hasher->hashPassword($contributor, $form->get('password')->getData());
      $contributor->setPassword($hash);

      $this->getDoctrine()->getManager()->flush();

      return $this->redirectToRoute(('profile/profile.html.twig'), [
        'contributor' => $contributor->getId(),
      ]);
    };

    return $this->renderForm('profile/edit.html.twig', [
      'contributor' => $contributor,
      'form' => $form,
    ]);
  }

}
