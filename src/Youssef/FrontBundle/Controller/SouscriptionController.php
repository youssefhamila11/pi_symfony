<?php

namespace Youssef\FrontBundle\Controller;

use Youssef\BackBundle\Entity\Offre;
use Youssef\BackBundle\Entity\Souscription;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
class SouscriptionController extends Controller
{

    public function souscrireViewAction(Request $request)
    {
        $montant = $request->get("montant");
        $tranche = $request->get("tranche");
        $enfant = $request->get("enfant");
        $conjoint = $request->get("conjoint");
        $id_offre = $request->get("idOffre");

        $souscription = new Souscription();
        $souscription->setNbEnfant($enfant);
        $souscription->setConjoint($conjoint);
        $souscription->setNombreTranche($tranche);
        $souscription->setMontant($montant);
        $souscription->setIdOffre($id_offre);
        $em = $this->getDoctrine()->getManager();
            $em->persist($souscription);
            $em->flush();
        return $this->render('@YoussefFront/Offre/recherche.html.twig', array(
            'a' => $montant,
            'b' => $tranche,
            'c' => $enfant,
            'd' => $conjoint,
            'e' => $id_offre,

        ));
    }


}