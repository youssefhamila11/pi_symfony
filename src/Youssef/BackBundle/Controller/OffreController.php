<?php

namespace Youssef\BackBundle\Controller;

use Youssef\BackBundle\Entity\Assureur;
use Youssef\BackBundle\Entity\Offre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Offre controller.
 *
 */
class OffreController extends Controller
{
    /**
     * Lists all offre entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $offres = $em->getRepository('YoussefBackBundle:Offre')->findAll();

        return $this->render('@YoussefBack/Offre/liste.html.twig', array(
            'offres' => $offres,
        ));
    }

    /**
     * Creates a new offre entity.
     *
     */
    public function newAction(Request $request)
    {
        $offre = new Offre();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm('Youssef\BackBundle\Form\OffreType', $offre);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ass = $em->getRepository('YoussefBackBundle:Assureur')->find('5');

            $offre->setAssureur($ass);
            $em = $this->getDoctrine()->getManager();
            $em->persist($offre);
            $em->flush();

            return $this->redirectToRoute('youssef_back_ajouter_offre');
        }

        return $this->render('@YoussefBack/Offre/ajout.html.twig', array(
            'offre' => $offre,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a offre entity.
     *
     */
    public function showAction(Offre $offre)
    {
        $deleteForm = $this->createDeleteForm($offre);

        return $this->render('offre/show.html.twig', array(
            'offre' => $offre,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing offre entity.
     *
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $offre = $em->getRepository('YoussefBackBundle:Offre')->find($id);
        $editForm = $this->createForm('Youssef\BackBundle\Form\OffreType', $offre);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('youssef_back_liste_offre');
        }

        return $this->render('@YoussefBack/Offre/modifier.html.twig', array(
            'offre' => $offre,
            'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a offre entity.
     *
     */
    public function deleteAction(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $offre=$em->getRepository("YoussefBackBundle:Offre")->find($id);
        $em->remove($offre);
        $em->flush();
        return $this->redirectToRoute('youssef_back_liste_offre');

    }

    /**
     * Creates a form to delete a offre entity.
     *
     * @param Offre $offre The offre entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Offre $offre)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('offre_delete', array('id' => $offre->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
