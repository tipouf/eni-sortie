<?php

namespace App\Controller;

use App\Entity\Contributor;
use App\Form\EditContributorType;
use App\Form\FileUploadType;
use App\Services\ContributorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profile")
 */
class ProfileController extends AbstractController
{
    private UserPasswordHasherInterface $hasher;
    private ContributorService $contributorService;

    /**
     * ProfileController constructor.
     */
    public function __construct(UserPasswordHasherInterface $hasher, ContributorService $contributorService)
    {
        $this->hasher = $hasher;
        $this->contributorService = $contributorService;
    }


    /**
     * @Route("/user/{contributor}", name="contributor_profile", methods={"GET", "POST"})
     */
    public function show(Request $request, Contributor $contributor): Response
    {
        $form = $this->createForm(FileUploadType::class, $contributor);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $file */
            $file = $form->get('profilePicture')->getData();
            $this->contributorService->uploadFile($file, $contributor, $this->getParameter('upload_directory'));
        }
        return $this->render('profile/profile.html.twig', [
            'contributor' => $contributor,
            'formImage' => $form->createView()
        ]);
    }

  /**
   * @Route("/new", name="contributor_new", methods={"GET", "POST"})
   */
  public function new(Request $request ): Response
  {
    $contributor = new Contributor();
    $form = $this->createForm(EditContributorType::class, $contributor);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $hash = $this->hasher->hashPassword($contributor, $form->get('password')->getData());
      $role = $form->get('roles')->getData();
      $contributor->setRoles([$role]);
      $contributor->setPassword($hash);

      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($contributor);
      $entityManager->flush();

      return $this->redirectToRoute('app_home');
    }

    return $this->renderForm('profile/new.html.twig', [
      'contributor' => $contributor,
      'form' => $form,
    ]);
  }

    /**
     * @Route("/edit/{contributor}", name="contributor_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Contributor $contributor): Response
    {
        $form = $this->createForm(EditContributorType::class, $contributor);
        $form->handleRequest($request);
        //$form = $this->createForm(FileUploadType::class);
        if ($form->isSubmitted() && $form->isValid()) {

            $hash = $this->hasher->hashPassword($contributor, $form->get('password')->getData());
            $contributor->setPassword($hash);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('contributor_profile', [
                'contributor' => $contributor->getId(),
            ]);
        }

        return $this->renderForm('profile/edit.html.twig', [
            'contributor' => $contributor,
            'form' => $form,
        ]);
    }

}
