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

        return $this->render('formulaire/preview.html.twig', ['formulaire' => $formulaire]);
    }

    /**
     * @Route("/pdf", name="pdf")
     */
    public function pdfAction(Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $userName = $request->get('user_name');
        $formulaire = $manager->getRepository(Formulaire::class)->findBy(['firstname' => $userName]);

        $filename = sprintf('test-%s.pdf', date('Y-m-d'));
        $snappy = $this->get('knp_snappy.pdf');

        $html = $this->renderView('pdf/test.html.twig', [
            'formulaire' => $formulaire,
            'base_dir' => $this->get('kernel')->getRootDir() . '/../web' . $request->getBasePath(),
        ]);

        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => sprintf('inline; filename="%s"', $filename),
            )
        );
    }
}
