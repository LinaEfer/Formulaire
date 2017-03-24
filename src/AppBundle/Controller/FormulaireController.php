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
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    public function submitFormulaireAction(Request $request)
    {
        $f = new Formulaire();

        $thisFormulaire = $this->createForm(FormulaireForm::class, $f);

        $thisFormulaire->handleRequest($request);

             if ($thisFormulaire->isSubmitted() && $thisFormulaire->isValid()) {

                 $form = $thisFormulaire->getData();

                 $fm = $this->getDoctrine()->getManager();
                 $fm->persist($form);
                 $fm->flush();

                 dump($thisFormulaire);
                 return new Response('magic');
             }

        return $this->render('formulaire/formulaire.html.twig', array(
            'form' => $thisFormulaire->createView(),
        ));

    }
}
