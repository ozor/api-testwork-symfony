<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\ModelInterface;
use App\Service\AbstractManager;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractApiController extends AbstractController
{
    protected function update(
        string          $updateUrl,
        AbstractManager $manager,
        ModelInterface  $model,
        string          $backLink,
    ): Response {
        try {
            $manager->setModel($model);
            $manager->update($updateUrl);
            return $this->redirectToRoute($backLink);
        } catch (Exception $exception) {
            return $this->render('common/error.html.twig', [
                'error' => $exception->getMessage(),
                'backlink' => $this->generateUrl($backLink),
            ]);
        }
    }

    public function renderError(Exception $exception, string $backLink)
    {
        return $this->render('common/error.html.twig', [
            'error' => $exception->getMessage(),
            'backlink' => $this->generateUrl($backLink),
        ]);
    }
}