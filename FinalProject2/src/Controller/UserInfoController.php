<?php

namespace App\Controller;

use App\Entity\UserInfo;
use App\Form\UserInfoType;
use App\Repository\UserInfoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/userinfo")
 */
class UserInfoController extends AbstractController
{
    /**
     * @Route("/", name="app_user_info_index", methods={"GET"})
     */
    public function index(UserInfoRepository $userInfoRepository): Response
    {
        return $this->render('user_info/index.html.twig', [
            'user_infos' => $userInfoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_user_info_new", methods={"GET", "POST"})
     */
    public function new(Request $request, UserInfoRepository $userInfoRepository): Response
    {
        $userInfo = new UserInfo();
        $form = $this->createForm(UserInfoType::class, $userInfo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userInfoRepository->add($userInfo, true);

            return $this->redirectToRoute('app_user_info_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user_info/new.html.twig', [
            'user_info' => $userInfo,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_user_info_show", methods={"GET"})
     */
    public function show(UserInfo $userInfo): Response
    {
        return $this->render('user_info/show.html.twig', [
            'user_info' => $userInfo,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_user_info_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, UserInfo $userInfo, UserInfoRepository $userInfoRepository): Response
    {
        $form = $this->createForm(UserInfoType::class, $userInfo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userInfoRepository->add($userInfo, true);

            return $this->redirectToRoute('app_user_info_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user_info/edit.html.twig', [
            'user_info' => $userInfo,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_user_info_delete", methods={"POST"})
     */
    public function delete(Request $request, UserInfo $userInfo, UserInfoRepository $userInfoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userInfo->getId(), $request->request->get('_token'))) {
            $userInfoRepository->remove($userInfo, true);
        }

        return $this->redirectToRoute('app_user_info_index', [], Response::HTTP_SEE_OTHER);
    }
}
