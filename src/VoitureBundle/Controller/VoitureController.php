<?php


namespace VoitureBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use VoitureBundle\Entity\Reservation;
use VoitureBundle\Entity\Voiture;
use VoitureBundle\Form\ReservationForm;
use VoitureBundle\Form\VoitureForm;

class VoitureController extends Controller
{
    public function listAction(){
        $m=$this->container->get('doctrine')->getEntityManager() ;
        $voiture= $m->getRepository('VoitureBundle:Voiture')->findAll();
        return $this->render('@Voiture/Voiture/list.html.twig',
            array(
                'voiture' =>$voiture
            ));
    }
    public function AddAction(Request $request) {
        $Voiture = new Voiture();
        $form  = $this->createForm(VoitureForm::class, $Voiture) ;

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em= $this->getDoctrine()->getManager();
            $em->persist($Voiture);
            $em->flush();
            return $this->redirect($this->generateUrl("affichage_Voiture"));
        }
        return $this->render('@Voiture/Voiture/Add.html.twig',
            array(
                'Form' => $form->createView()
            ) );
    }

    public function DeleteAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $voiture = $em->getRepository('VoitureBundle:Voiture')->find($id);
        if ($voiture !== null) {
            $em->remove($voiture);
            $em->flush();
        }
        else
            throw new NotFoundHttpException("la voiture numero ". $id. "n existe pas");
        return $this->redirectToRoute("affichage_Voiture");
    }

    public function rechercheAction(Request $request) {
        $em= $this->container ->get('doctrine')->getEntityManager();
        $voiture = $em->getRepository('VoitureBundle:Voiture')->findall() ;
        if ($request->getMethod("POST")) {
            $motcle = $request->get("input_recherche");
            $query = $em->createQuery(
                "SELECT v FROM VoitureBundle:Voiture v WHERE v.matricule like '".$motcle."%'"
            );
            $voiture = $query->getResult();

        }

        return $this->render('@Voiture/Voiture/Recherche.html.twig',
            array(
                'voiture' => $voiture
            ));
    }

    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $voiture = $em->getRepository('VoitureBundle:Voiture')->find($id);

        $editForm = $this->createForm(VoitureForm::class, $voiture);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('edit_voiture', array('id' => $voiture->getMatricule()));
        }

        return $this->render('@Voiture/Voiture/edit.html.twig', array(
            'Voiture' => $voiture,
            'edit_form' => $editForm->createView(),

        ));
    }

    public function showAction(Voiture $voiture)
    {
        $deleteForm = $this->createForm(VoitureForm::class,$voiture);

        return $this->render('@Voiture/Voiture/show.html.twig', array(
            'voiture' => $voiture,
            'delete_form' => $deleteForm->createView(),
        ));
    }








}