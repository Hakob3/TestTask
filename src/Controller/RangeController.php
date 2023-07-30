<?php

namespace App\Controller;

use App\Form\FindRangeType;
use App\Repository\RangeRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RangeController extends AbstractController
{
    /**
     * @param Request $request
     * @param RangeRepository $rangeRepository
     * @return Response
     * @throws NonUniqueResultException
     */
    #[Route('/find_range', name: 'find_range')]
    public function index(Request $request, RangeRepository $rangeRepository): Response
    {
        $form = $this->createForm(FindRangeType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $range = $rangeRepository->findRangeBySearchNumber($formData['searchNumber']);

            return $this->render('range/range.html.twig', [
                'rangeId' => $range->getId()
            ]);
        }

        return $this->render(
            'range/form.html.twig', [
                'form' => $form->createView()
            ]
        );
    }
}
