<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\Type\HttpType;
use App\Service\Http\Manager;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HttpController extends AbstractApiController
{
    #[Route('/api/http', name: 'api_http_index')]
    public function index(
        Request $request,
        Manager $manager,
    ): Response {
        $getUrl    = $this->getParameter('http_url_get');
        $updateUrl = $this->getParameter('http_url_update');

        try {
            $model = $manager->get($getUrl);
        } catch (Exception $exception) {
            return $this->renderError($exception, 'api_dashboard');
        }

        $form = $this->createForm(HttpType::class, $model);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $manager->setModel($model);
                $manager->update($updateUrl);
                return $this->redirectToRoute('api_http_index');
            } catch (Exception $exception) {
                return $this->renderError($exception, 'api_http_index');
            }
        }

        return $this->render('api/http/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
