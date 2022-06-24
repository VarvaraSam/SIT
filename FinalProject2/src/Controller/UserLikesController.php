<?php

namespace App\Controller;

use App\Entity\UserLikes;
use App\Form\UserLikesType;
use App\Repository\UserLikesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/userlikes")
 */
class UserLikesController extends AbstractController
{
    /**
     * @Route("/", name="app_user_likes_index", methods={"GET"})
     */
    public function index(UserLikesRepository $userLikesRepository): Response
    {
        return $this->render('user_likes/index.html.twig', [
            'user_likes' => $userLikesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_user_likes_new", methods={"GET", "POST"})
     */
    public function new(Request $request, UserLikesRepository $userLikesRepository): Response
    {
        $userLike = new UserLikes();
        $form = $this->createForm(UserLikesType::class, $userLike);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userLikesRepository->add($userLike, true);

            return $this->redirectToRoute('app_user_likes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user_likes/new.html.twig', [
            'user_like' => $userLike,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_user_likes_show", methods={"GET"})
     */
    public function show(UserLikes $userLike): Response
    {
        return $this->render('user_likes/show.html.twig', [
            'user_like' => $userLike,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_user_likes_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, UserLikes $userLike, UserLikesRepository $userLikesRepository): Response
    {
        $form = $this->createForm(UserLikesType::class, $userLike);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userLikesRepository->add($userLike, true);

            return $this->redirectToRoute('app_user_likes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user_likes/edit.html.twig', [
            'user_like' => $userLike,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_user_likes_delete", methods={"POST"})
     */
    public function delete(Request $request, UserLikes $userLike, UserLikesRepository $userLikesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userLike->getId(), $request->request->get('_token'))) {
            $userLikesRepository->remove($userLike, true);
        }

        return $this->redirectToRoute('app_user_likes_index', [], Response::HTTP_SEE_OTHER);
    }
}
