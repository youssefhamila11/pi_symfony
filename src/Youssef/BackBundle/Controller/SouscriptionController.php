<?php

namespace Youssef\BackBundle\Controller;

use Youssef\BackBundle\Entity\Souscription;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Souscription controller.
 *
 */
class SouscriptionController extends Controller
{
    /**
     * Lists all souscription entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $souscriptions = $em->getRepository('YoussefBackBundle:Souscription')->findAll();

        return $this->render('@YoussefBack/Souscription/liste.html.twig', array(
            'souscriptions' => $souscriptions,
        ));
    }

    /**
     * Creates a new souscription entity.
     *
     */
    public function newAction(Request $request)
    {
        $souscription = new Souscription();
        $form = $this->createForm('Youssef\BackBundle\Form\SouscriptionType', $souscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($souscription);
            $em->flush();

            return $this->redirectToRoute('youssef_back_liste_Souscription');
        }

        return $this->render('@YoussefBack/Souscription/ajout.html.twig', array(
            'souscription' => $souscription,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a souscription entity.
     *
     */
    public function showAction(Souscription $souscription)
    {
        $deleteForm = $this->createDeleteForm($souscription);

        return $this->render('souscription/show.html.twig', array(
            'souscription' => $souscription,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing souscription entity.
     *
     */
    public function editAction(Request $request, $id )
    {
        $em = $this->getDoctrine()->getManager();
        $souscription = $em->getRepository('YoussefBackBundle:Souscription')->find($id);
        $editForm = $this->createForm('Youssef\BackBundle\Form\SouscriptionType', $souscription);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('youssef_back_liste_Souscription');
        }

        return $this->render('@YoussefBack/Offre/modifier.html.twig', array(
            'offre' => $souscription,
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a souscription entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $souscription=$em->getRepository("YoussefBackBundle:Souscription")->find($id);
        $em->remove($souscription);
        $em->flush();
        return $this->redirectToRoute('youssef_back_liste_Souscription');
    }


}
