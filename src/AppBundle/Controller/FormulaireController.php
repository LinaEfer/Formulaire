<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Formulaire;
use AppBundle\Form\FormulaireForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FormulaireController extends Controller
{
    /**
     * @Route("/", name="homepage")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function submitFormulaireAction(Request $request)
    {
        $thisFormulaire = $this->createForm(FormulaireForm::class);

        $thisFormulaire->handleRequest($request);

        if ($thisFormulaire->isSubmitted() && $thisFormulaire->isValid()) {
            $form = $thisFormulaire->getData();

            $fm = $this->getDoctrine()->getManager();
            $fm->persist($form);
            $fm->flush();

            return $this->redirectToRoute('preview');
        }

        return $this->render('formulaire/formulaire.html.twig', [
            'form' => $thisFormulaire->createView(),
        ]);
    }

    /**
     * @Route("/preview", name="preview")
     *
     * @param Request $request
     */
    public function previewAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $formulaire = $manager->getRepository(Formulaire::class)->findAll();

        //dump($formulaire);
        //return new Response('magic');

        return $this->render('formulaire/preview.html.twig', ['formulaire' => $formulaire]);
    }

    public function createPdf($html)
    {
        $pdf = $this->get('white_october.tcpdf')->create('vertical', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->SetAuthor('Our Code World');
        $pdf->SetTitle(('Our Code World Title'));
        $pdf->SetSubject('Our Code World Subject');
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('helvetica', '', 11, '', true);
        $pdf->SetMargins(20, 20, 40, true);
        $pdf->AddPage();

        $filename = 'ourcodeworld_pdf_demo';

        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        $pdf->Output($filename.'.pdf', 'I'); // This will output the PDF as a response directly
    }

    /**
     *@Route("/pdf", name="pdf")
     */
    public function indexAction()
    {
        $html = '<h1>Plain HTML</h1>';
/*
        $manager = $this->getDoctrine()->getManager();
        $formulaire = $manager->getRepository(Formulaire::class)->findAll();

        $html = $this->renderView(
            'formulaire/preview.html.twig',
             ['formulaire' => $formulaire]
        );*/

        $this->createPdf($html);
    }
}
