<?php


namespace VoitureBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use VoitureBundle\Entity\Administrateur;
use VoitureBundle\Entity\Client;
use VoitureBundle\Form\AdministrateurForm;
use VoitureBundle\Form\ClientForm;

class AdministrateurController extends Controller
{
    public function listAction(){
        $m=$this->container->get('doctrine')->getEntityManager() ;
        $admin= $m->getRepository('VoitureBundle:Administrateur')->findAll();
        return $this->render('@Voiture/Administrateur/list.html.twig',
            array(
                'admin' =>$admin
            ));
    }
    public function AddAction(Request $request) {
        $admin = new Administrateur();
        $form  = $this->createForm(AdministrateurForm::class, $admin) ;

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em= $this->getDoctrine()->getManager();
            $em->persist($admin);
            $em->flush();
            return $this->redirect($this->generateUrl("affichage_admin"));
        }
        return $this->render('@Voiture/Administrateur/Add.html.twig',
            array(
                'Form' => $form->createView()
            ) );
    }

    public function DeleteAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $admin = $em->getRepository('VoitureBundle:Administrateur')->find($id);
        if ($admin  !== null) {
            $em->remove($admin );
            $em->flush();
        }
        else
            throw new NotFoundHttpException("l administrateur numero ". $id. " n existe pas");
        return $this->redirectToRoute("affichage_admin");
    }
    public function rechercheAction(Request $request) {
        $em= $this->container ->get('doctrine')->getEntityManager();
        $admin = $em->getRepository('VoitureBundle:Administrateur')->findall() ;
        if ($request->getMethod("POST")) {
            $motcle = $request->get("input_recherche");
            $query = $em->createQuery(
                "SELECT a FROM VoitureBundle:Administrateur a WHERE a.AdminCIN like '".$motcle."%'"
            );
            $admin = $query->getResult();

        }

        return $this->render('@Voiture/Administrateur/Recherche.html.twig',
            array(
                'admin' => $admin
            ));
    }

    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $admin = $em->getRepository('VoitureBundle:Administrateur')->find($id);

        $editForm = $this->createForm(AdministrateurForm::class, $admin);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('edit_admin', array('id' => $admin->getAdminCIN()));
        }

        return $this->render('@Voiture/Administrateur/edit.html.twig', array(
            'admin' => $admin,
            'edit_form' => $editForm->createView(),

        ));
    }
    public function showAction(Administrateur $admin)
    {
        $deleteForm = $this->createForm(AdministrateurForm::class,$admin);

        return $this->render('@Voiture/Administrateur/show.html.twig', array(
            'admin' => $admin,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function indexAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $admin = $em->getRepository('VoitureBundle:Administrateur')->find($id);

        return $this->render('@Voiture/Administrateur/index.html.twig', array(
            'admin' => $admin,
        ));
    }






}
