<?php

namespace Youssef\FrontBundle\Controller;

use Youssef\BackBundle\Entity\Offre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
class OffreController extends Controller
{

    public function rechercheOffresAction()
    {
        return $this->render('@YoussefFront/Offre/recherche.html.twig');
    }
    public function afficheOffresCalculeAction(Request $request)
    {
        $c="";
        $nbEnfant = $request->get("enfant");
        $conjoint = $request->get("conjoint");
        $em = $this->getDoctrine()->getManager();
        $offres = $em->getRepository('YoussefBackBundle:Offre')->findAll();
        if($conjoint=="")
        {
            $c="non";
            /*foreach ($offres as $offre)
            {
                $m=$offre->getPrixDeBaseOffre()+(($offre->getPrixDeBaseOffre()*$nbEnfant*$offre->getPrEnfant())/100);
                $offre->setMontant($m);
            }*/
        }
        elseif ($conjoint=="oui")
        {
                $c="oui";
            /*foreach ($offres as $offre)
            {
                $l=$offre->getPrixDeBaseOffre()+(($offre->getPrixDeBaseOffre()*$offre->getPrConjoint())/100)+(($offre->getPrixDeBaseOffre()*$nbEnfant*$offre->getPrEnfant())/100);
                $offre->setMontant($l);
            }*/
        }
        $em = $this->getDoctrine()->getManager();



        return $this->render('@YoussefFront/Offre/afficheCalcule.html.twig', array(
            'offres' => $offres,
            'c' => $c,
            'e' => $nbEnfant,

        ));
    }
    public function afficheOffreAction($id,$conjoint,$enfant,$montant)
    {
        $em = $this->getDoctrine()->getManager();

        $offre = $em->getRepository('YoussefBackBundle:Offre')->find($id);

        return $this->render('@YoussefFront/Offre/afficheOffre.html.twig', array(
            'offre' => $offre,
            'montant' => $montant,
            'c' => $conjoint,
            'e' => $enfant,
        ));
    }


}