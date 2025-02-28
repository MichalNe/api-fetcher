<?php

declare(strict_types=1);

namespace App\Presentation\Front\Controller;

use App\Application\ApiFetcherService;
use App\Application\DTO\Point\PointInputFormDTO;
use App\Application\Strategy\ResourceStrategyEnum;
use App\Presentation\Front\Form\PointType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PointController extends AbstractController
{
    #[Route(path: '/points', name: 'app_points', methods: ['GET', 'POST'])]
    public function getPoints(Request $request, ApiFetcherService $apiFetcherService): Response
    {
        $result = null;

        $form = $this->createForm(PointType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var PointInputFormDTO $pointInputDto */
            $pointInputDto = $form->getData();

            $result = $apiFetcherService->fetch(ResourceStrategyEnum::POINTS->value, $pointInputDto->getCity());
        }

        return $this->render('form/form.html.twig', [
            'form' => $form->createView(),
            'result' => $result,
        ]);
    }
}