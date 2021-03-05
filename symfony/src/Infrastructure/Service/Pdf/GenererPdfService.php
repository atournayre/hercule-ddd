<?php

namespace App\Infrastructure\Service\Pdf;

use App\Domain\Entity\Utilisateur\Utilisateur;
use App\Domain\Interfaces\Pdf\GenererPdfServiceInterface;
use App\Domain\Interfaces\Pdf\PdfServiceInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class GenererPdfService implements GenererPdfServiceInterface
{
    /**
     * @var Environment
     */
    private $environment;
    /**
     * @var PdfServiceInterface
     */
    protected $pdfService;

    public function __construct(Environment $environment, PdfServiceInterface $pdfService)
    {
        $this->environment = $environment;
        $this->pdfService = $pdfService;
    }

    /**
     * @param string $template
     * @param Utilisateur|object $object
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function genererPdf(string $template, $object): string
    {
        return $this->environment->render(
            $template,
            $this->pdfService->getDonneesPourPdf($object)
        );
    }
}
