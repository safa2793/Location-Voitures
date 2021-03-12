<?php


namespace VoitureBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use VoitureBundle\Entity\Administrateur;
use VoitureBundle\Entity\Facture;
use VoitureBundle\Form\AdministrateurForm;
use VoitureBundle\Form\FactureForm;

class FactureController extends Controller
{
    public function listAction(){
        $m=$this->container->get('doctrine')->getEntityManager() ;
        $fact= $m->getRepository('VoitureBundle:Facture')->findAll();
        return $this->render('@Voiture/Facture/list.html.twig',
            array(
                'fact' =>$fact
            ));
    }
    public function AddAction(Request $request) {
        $fact = new Facture();
        $form  = $this->createForm(FactureForm::class, $fact) ;

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em= $this->getDoctrine()->getManager();
            $em->persist($fact);
            $em->flush();
            return $this->redirect($this->generateUrl("affichage_fact"));
        }
        return $this->render('@Voiture/Facture/Add.html.twig',
            array(
                'Form' => $form->createView()
            ) );
    }

    public function DeleteAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $fact = $em->getRepository('VoitureBundle:Facture')->find($id);
        if ($fact  !== null) {
            $em->remove($fact);
            $em->flush();
        }
        else
            throw new NotFoundHttpException("la facture numero ". $id. " n existe pas");
        return $this->redirectToRoute("affichage_fact");
    }
    public function rechercheAction(Request $request) {
        $em= $this->container ->get('doctrine')->getEntityManager();
        $fact = $em->getRepository('VoitureBundle:Facture')->findall() ;
        if ($request->getMethod("POST")) {
            $motcle = $request->get("input_recherche");
            $query = $em->createQuery(
                "SELECT f FROM VoitureBundle:Facture f WHERE f.IdFacture like '".$motcle."%'"
            );
            $fact = $query->getResult();

        }

        return $this->render('@Voiture/Facture/Recherche.html.twig',
            array(
                'fact' => $fact
            ));
    }

    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $fact = $em->getRepository('VoitureBundle:Facture')->find($id);

        $editForm = $this->createForm(FactureForm::class, $fact);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('edit_fact', array('id' => $fact->getIdFacture()));
        }

        return $this->render('@Voiture/Facture/edit.html.twig', array(
            'fact' => $fact,
            'edit_form' => $editForm->createView(),

        ));
    }

    public function showAction(Facture $fact)
    {
        $deleteForm = $this->createForm(FactureForm::class,$fact);

        return $this->render('@Voiture/Facture/show.html.twig', array(
            'fact' => $fact,
            'delete_form' => $deleteForm->createView(),
        ));
    }






}