<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\Type\GrpcType;
use App\Model\Grpc;
use App\Service\Grpc\Manager;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GrpcController extends AbstractApiController
{
    #[Route('/api/grpc', name: 'api_grpc_index')]
    public function index(
        Request $request,
        Manager $manager,
    ): Response {
        $getUrl    = $this->getParameter('grpc_url_get');
        $updateUrl = $this->getParameter('grpc_url_update');

        try {
            $model = $manager->get($getUrl);
        } catch (Exception $exception) {
            return $this->renderError($exception, 'api_dashboard');
        }

        $form = $this->createForm(GrpcType::class, $model);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $manager->setModel($model);
                $manager->update($updateUrl);
                return $this->redirectToRoute('api_grpc_index');
            } catch (Exception $exception) {
                return $this->renderError($exception, 'api_grpc_index');
            }
        }

        return $this->render('api/grpc/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
