<?php

namespace App\Infrastructure\Service\Pdf;

use App\Domain\Interfaces\Pdf\EntitePdfInterface;
use App\Domain\Interfaces\Pdf\GenererPdfServiceInterface;
use App\Domain\Interfaces\Pdf\PdfServiceInterface;
use InvalidArgumentException;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class GenererPdfService implements GenererPdfServiceInterface
{
    const TEMPLATE_MANQUANT_EXCEPTION_MESSAGE = 'La génération d\'un PDF requiert un template.';

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
            throw new InvalidArgumentException(self::TEMPLATE_MANQUANT_EXCEPTION_MESSAGE);
        }

        $this->template = $template;
    }

    /**
     * @param EntitePdfInterface $entitePdf
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function genererPdf(EntitePdfInterface $entitePdf): string
    {
        return $this->environment->render(
            $this->template,
            $this->pdfService->getDonneesPourPdf($entitePdf)
        );
    }
}
