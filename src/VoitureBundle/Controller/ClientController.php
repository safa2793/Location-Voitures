<?php


namespace VoitureBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use VoitureBundle\Entity\Client;
use VoitureBundle\Form\ClientForm;

class ClientController extends Controller
{

    public function listAction(){
        $m=$this->container->get('doctrine')->getEntityManager() ;
        $client= $m->getRepository('VoitureBundle:Client')->findAll();
        return $this->render('@Voiture/Client/list.html.twig',
            array(
                'client' =>$client
            ));
    }

    public function AddAction(Request $request) {
        $Client = new Client();
        $form  = $this->createForm(ClientForm::class, $Client) ;

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em= $this->getDoctrine()->getManager();
            $em->persist($Client);
            $em->flush();
            return $this->redirect($this->generateUrl("affichage_client"));
        }
        return $this->render('@Voiture/Client/Add.html.twig',
            array(
                'Form' => $form->createView()
            ) );
    }

    public function DeleteAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $Client = $em->getRepository('VoitureBundle:Client')->find($id);
        if ($Client !== null) {
            $em->remove($Client);
            $em->flush();
        }
        else
            throw new NotFoundHttpException("le client numero ". $id. " n existe pas");
        return $this->redirectToRoute("affichage_client");
    }

    public function rechercheAction(Request $request) {
        $em= $this->container ->get('doctrine')->getEntityManager();
        $Client = $em->getRepository('VoitureBundle:Client')->findall() ;
        if ($request->getMethod("POST")) {
            $motcle = $request->get("input_recherche");
            $query = $em->createQuery(
                "SELECT c FROM VoitureBundle:Client c WHERE c.ClientId like '".$motcle."%'"
            );
            $Client = $query->getResult();

        }

        return $this->render('@Voiture/Client/Recherche.html.twig',
            array(
                'Client' => $Client
            ));
    }


    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $Client = $em->getRepository('VoitureBundle:Client')->find($id);

        $editForm = $this->createForm(ClientForm::class, $Client);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('edit_client', array('id' => $Client->getClientId()));
        }

        return $this->render('@Voiture/Client/edit.html.twig', array(
            'Client' => $Client,
            'edit_form' => $editForm->createView(),

        ));
    }

    public function showAction(Client $client)
    {
        $deleteForm = $this->createForm(ClientForm::class,$client);

        return $this->render('@Voiture/Client/show.html.twig', array(
            'client' => $client,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function indexAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $Client = $em->getRepository('VoitureBundle:Client')->find($id);

        return $this->render('@Voiture/Client/index.html.twig', array(
            'client' => $Client,
        ));
    }









}