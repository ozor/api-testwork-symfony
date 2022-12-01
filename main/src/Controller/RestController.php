<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\Type\RestType;
use App\Service\Rest\Manager;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestController extends AbstractApiController
{
    #[Route('/api/rest', name: 'api_rest_index')]
    public function index(
        Request $request,
        Manager $manager,
    ): Response {
        $getUrl    = $this->getParameter('rest_url_get');
        $updateUrl = $this->getParameter('rest_url_update');

        try {
            $model = $manager->get($getUrl);
        } catch (Exception $exception) {
            return $this->renderError($exception, 'api_dashboard');
        }

        $form = $this->createForm(RestType::class, $model);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $manager->setModel($model);
                $manager->update($updateUrl);
                return $this->redirectToRoute('api_rest_index');
            } catch (Exception $exception) {
                return $this->renderError($exception, 'api_rest_index');
            }
        }

        return $this->render('api/rest/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
