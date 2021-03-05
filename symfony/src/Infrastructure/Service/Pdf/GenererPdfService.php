<?php

namespace App\Infrastructure\Service\Pdf;

use App\Domain\Entity\Utilisateur\Utilisateur;
use App\Domain\Interfaces\Pdf\GenererPdfServiceInterface;
use App\Domain\Interfaces\Pdf\PdfServiceInterface;
use InvalidArgumentException;
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
    private $pdfService;
    /**
     * @var string
     */
    private $template;

    public function __construct(Environment $environment, PdfServiceInterface $pdfService, ?string $template = null)
    {
        $this->environment = $environment;
        $this->pdfService = $pdfService;

        if (is_null($template)) {
            throw new InvalidArgumentException('La génération d\'un PDF requiert un template.');
        }

        $this->template = $template;
    }

    /**
     * @param string $template
     * @param Utilisateur|object $object
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function genererPdf($object): string
    {
        return $this->environment->render(
            $this->template,
            $this->pdfService->getDonneesPourPdf($object)
        );
    }
}
