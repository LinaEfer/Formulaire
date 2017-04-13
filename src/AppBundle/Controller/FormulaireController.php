<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Formulaire;
use AppBundle\Form\FormulaireForm;
use Doctrine\Common\Persistence\ManagerRegistry;
use Knp\Snappy\GeneratorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Templating\EngineInterface;

/**
 * @Route(service="app.controller.form")
 */
class FormulaireController
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var GeneratorInterface
     */
    private $snappy;

    /**
     * @var ManagerRegistry
     */
    private $registry;

    private $rootDir;

    /**
     * @var EngineInterface
     */
    private $engine;

    /**
     * @var UrlGeneratorInterface
     */
    private $redirect;

    /**
     * FormulaireController constructor.
     *
     * @param ManagerRegistry    $registry
     * @param GeneratorInterface $snappy
     * @param $rootDir
     * @param FormFactoryInterface  $formFactory
     * @param EngineInterface       $engine
     * @param UrlGeneratorInterface $redirect
     */
    public function __construct(ManagerRegistry $registry,
                                GeneratorInterface $snappy,
                                $rootDir,
                                FormFactoryInterface $formFactory,
                                EngineInterface $engine,
                                UrlGeneratorInterface $redirect)
    {
        $this->registry = $registry;
        $this->snappy = $snappy;
        $this->rootDir = $rootDir;
        $this->formFactory = $formFactory;
        $this->engine = $engine;
        $this->redirect = $redirect;
    }

    /**
     * @Route("/", name="homepage")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function submitFormulaireAction(Request $request)
    {
        $thisFormulaire = $this->formFactory->create(FormulaireForm::class);
        $thisFormulaire->handleRequest($request);

        if ($thisFormulaire->isSubmitted() && $thisFormulaire->isValid()) {
            $form = $thisFormulaire->getData();

            $fm = $this->registry->getManager();
            $fm->persist($form);
            $fm->flush();

            return new RedirectResponse($this->redirect->generate('preview'));
        }

        return new Response($this->engine->render('formulaire/formulaire.html.twig', [
            'form' => $thisFormulaire->createView(),
        ]));
    }

    /**
     * @Route("/preview", name="preview")
     *
     * @param Request $request
     */
    public function previewAction(Request $request)
    {
        $manager = $this->registry->getManager();
        $formulaire = $manager->getRepository(Formulaire::class)->findAll();

        return new Response($this->engine->render('formulaire/preview.html.twig', ['formulaire' => $formulaire]));
    }

    /**
     * @Route("/pdf", name="pdf")
     */
    public function pdfAction(Request $request)
    {
        $manager = $this->registry->getManager();
        $userName = $request->get('user_name');
        $formulaire = $manager->getRepository(Formulaire::class)->findBy(['firstname' => $userName]);

        $filename = sprintf('test-%s.pdf', date('Y-m-d'));

        $html = $this->engine->render('pdf/test.html.twig', [
            'formulaire' => $formulaire,
            'base_dir' => $this->rootDir.'/../web'.$request->getBasePath(),
        ]);

        return new Response(
            $this->snappy->getOutputFromHtml($html),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => sprintf('inline; filename="%s"', $filename),
            ]
        );
    }
}
