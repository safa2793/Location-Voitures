<?php


namespace VoitureBundle\Controller;
use \Symfony\Bundle\FrameworkBundle\Controller\Controller;
use VoitureBundle\Entity\Reservation;
use VoitureBundle\Form\ReservationForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class ReservationController extends Controller
{
    public function listAction(){
        $m=$this->container->get('doctrine')->getEntityManager() ;
        $reservation= $m->getRepository('VoitureBundle:Reservation')->findAll();
        return $this->render('@Voiture/Reservation/list.html.twig',
            array(
                'Reservation' =>$reservation
            ));
    }

    public function AddAction(Request $request) {
        $Reservation = new Reservation();
        $form  = $this->createForm(ReservationForm::class, $Reservation) ;

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em= $this->getDoctrine()->getManager();
            $em->persist($Reservation);
            $em->flush();
            return $this->redirect($this->generateUrl("Affichage_resa"));
        }
        return $this->render('@Voiture/Reservation/Add.html.twig',
            array(
                'Form' => $form->createView()
            ) );
    }

    public function DeleteAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $reservation = $em->getRepository('VoitureBundle:Reservation')->find($id);
        if ($reservation !== null) {
            $em->remove($reservation);
            $em->flush();
        }
        else
            throw new NotFoundHttpException("la reservation numero ". $id. "n existe pas");
        return $this->redirectToRoute("Affichage_resa"); 
    }

    public function rechercheAction(Request $request) {
        $em= $this->container ->get('doctrine')->getEntityManager();
        $Reservation = $em->getRepository('VoitureBundle:Reservation')->findall() ;
        if ($request->getMethod("POST")) {
            $motcle = $request->get("input_recherche");
            $query = $em->createQuery(
                "SELECT r FROM VoitureBundle:Reservation r WHERE r.ReservationId like '".$motcle."%'"
            );
            $Reservation = $query->getResult();

        }

        return $this->render('@Voiture/Reservation/Recherche.html.twig',
            array(
                'Reservation' => $Reservation
            ));
    }
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $resa = $em->getRepository('VoitureBundle:Reservation')->find($id);

        $editForm = $this->createForm(ReservationForm::class, $resa);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('edit_resa', array('id' => $resa->getReservationId()));
        }

        return $this->render('@Voiture/Reservation/edit.html.twig', array(
            'resa' => $resa,
            'edit_form' => $editForm->createView(),

        ));
    }

    public function showAction(Reservation $resa)
    {
        $deleteForm = $this->createForm(ReservationForm::class,$resa);

        return $this->render('@Voiture/Reservation/show.html.twig', array(
            'resa' => $resa,
            'delete_form' => $deleteForm->createView(),
        ));
    }










}