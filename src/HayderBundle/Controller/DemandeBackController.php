<?php

namespace HayderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use HayderBundle\Entity\Demande;
use Symfony\Component\HttpFoundation\Request;

class DemandeBackController extends Controller
{
    /**
     * Lists all demande entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $dql   = "SELECT a FROM HayderBundle:Demande a";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );


        return $this->render('@HayderBundle/back/demande/index.html.twig', array(
            'demandes' => $pagination,
        ));
    }

    /**
     * Creates a new demande entity.
     *
     */
    public function newAction(Request $request)
    {
        $demande = new Demande();
        $form = $this->createForm('HayderBundle\Form\DemandeType', $demande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($demande);
            $em->flush();

            return $this->redirectToRoute('demande_show_back', array('id' => $demande->getId()));
        }

        return $this->render('@HayderBundle/back/demande/new.html.twig', array(
            'demande' => $demande,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a demande entity.
     *
     */
    public function showAction(Demande $demande)
    {
        $deleteForm = $this->createDeleteForm($demande);

        return $this->render('@HayderBundle/back/demande/show.html.twig', array(
            'demande' => $demande,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing demande entity.
     *
     */
    public function editAction(Request $request, Demande $demande)
    {
        $deleteForm = $this->createDeleteForm($demande);
        $editForm = $this->createForm('HayderBundle\Form\DemandeType', $demande);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('demande_edit_back', array('id' => $demande->getId()));
        }

        return $this->render('@HayderBundle/back/demande/edit.html.twig', array(
            'demande' => $demande,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a demande entity.
     *
     */
    public function deleteAction(Request $request, Demande $demande)
    {
        $form = $this->createDeleteForm($demande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($demande);
            $em->flush();
        }

        return $this->redirectToRoute('demande_index_back');
    }


    public function repondreAction(){
        dump($_POST);


        $em = $this->getDoctrine()->getManager();
        $reclamation = $em->getRepository(Demande::class)->find($_POST['id']);

        $reclamation->setReponse($_POST['reponse']);
        $reclamation->setEtat($_POST['etat']);
        $em->flush();

        return $this->redirectToRoute('demande_index_back');

    }

    /**
     * Creates a form to delete a demande entity.
     *
     * @param Demande $demande The demande entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Demande $demande)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('demande_delete', array('id' => $demande->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
