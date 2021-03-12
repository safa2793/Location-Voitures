<?php


namespace VoitureBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use VoitureBundle\Entity\Gestionnaire;
use VoitureBundle\Form\GestionnaireForm;

class GestionnaireController extends Controller
{
    public function listAction(){
        $m=$this->container->get('doctrine')->getEntityManager() ;
        $gestionnaire= $m->getRepository('VoitureBundle:Gestionnaire')->findAll();
        return $this->render('@Voiture/Gestionnaire/list.html.twig',
            array(
                'gestionnaire' =>$gestionnaire
            ));
    }

    public function AddAction(Request $request) {
        $Gestionnaire = new Gestionnaire();
        $form  = $this->createForm(GestionnaireForm::class, $Gestionnaire) ;

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em= $this->getDoctrine()->getManager();
            $em->persist($Gestionnaire);
            $em->flush();
            return $this->redirect($this->generateUrl("affichage_gestionnaire"));
        }
        return $this->render('@Voiture/Gestionnaire/Add.html.twig',
            array(
                'Form' => $form->createView()
            ) );
    }


    public function DeleteAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $Gestionnaire = $em->getRepository('VoitureBundle:Gestionnaire')->find($id);
        if ($Gestionnaire !== null) {
            $em->remove($Gestionnaire);
            $em->flush();
        }
        else
            throw new NotFoundHttpException("le gestionnaire numero ". $id. " n existe pas");
        return $this->redirectToRoute("affichage_gestionnaire");
    }

    public function rechercheAction(Request $request) {
        $em= $this->container ->get('doctrine')->getEntityManager();
        $gestionnaire = $em->getRepository('VoitureBundle:Gestionnaire')->findall() ;
        if ($request->getMethod("POST")) {
            $motcle = $request->get("input_recherche");
            $query = $em->createQuery(
                "SELECT g FROM VoitureBundle:Gestionnaire g WHERE g.GestionnaireCIN like '".$motcle."%'"
            );
            $gestionnaire = $query->getResult();

        }

        return $this->render('@Voiture/Gestionnaire/Recherche.html.twig',
            array(
                'gestionnaire' => $gestionnaire
            ));
    }
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $gestionnaire = $em->getRepository('VoitureBundle:Gestionnaire')->find($id);

        $editForm = $this->createForm(GestionnaireForm::class, $gestionnaire);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('edit_gestionnaire', array('id' => $gestionnaire->getGestionnaireCIN()));
        }

        return $this->render('@Voiture/Gestionnaire/edit.html.twig', array(
            'gestionnaire' => $gestionnaire,
            'edit_form' => $editForm->createView(),

        ));
    }
    public function showAction(Gestionnaire $gestionnaire)
    {
        $deleteForm = $this->createForm(GestionnaireForm::class,$gestionnaire);

        return $this->render('@Voiture/Gestionnaire/show.html.twig', array(
            'gestionnaire' => $gestionnaire,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function indexAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $gestionnaire = $em->getRepository('VoitureBundle:Gestionnaire')->find($id);

        return $this->render('@Voiture/Gestionnaire/index.html.twig', array(
            'gestionnaire' => $gestionnaire,
        ));
    }

}