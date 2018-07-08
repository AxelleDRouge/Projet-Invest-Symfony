<?php

namespace ProjetInvest\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ProjetInvest\ProjetPresentationBundle\Entity\Project;
use ProjetInvest\ProjetPresentationBundle\Form\ProjectType;
use ProjetInvest\ProjetPresentationBundle\Entity\Image;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class AdminController extends Controller
{

	/**
	 * @Security("has_role('ROLE_ADMIN')")
	 */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        // liste des projets
        $listProjects = $em->getRepository('ProjetInvestProjetPresentationBundle:Project')->findAll();

        return $this->render('ProjetInvestAdminBundle:Admin:index.html.twig',array('listProjects' => $listProjects
        ));
    }

    public function viewAction($id)
    {
		// on récupère le repository
		$repository = $this->getDoctrine()
			->getManager()
			->getRepository('ProjetInvestProjetPresentationBundle:Project')
		;

		// on récupère le projet correspondant à id
		$project = $repository->find($id);

		// vérifier que if existe
		if(null === $project){
			throw new NotFoundHttpException("Le projet d'id".$id." n'existe pas.");
		}
    	
    	return $this->render('ProjetInvestAdminBundle:Admin:view.html.twig', array(
			'project' => $project
		));
    }

    public function addprojectAction(Request $request)
    {
    	// création de l'entité project
    	$project = new Project();

    	// on ajoute les champs de l'entité que l'on veut à notre formulaire
    	$form = $this->get('form.factory')->create(ProjectType::class, $project);

    	 if($request->isMethod('POST')){
    	 	$form->handleRequest($request);

    	 	if($form->isValid()){
    	 		$em = $this->getDoctrine()->getManager();
    	 		$em->persist($project);
    	 		$em->flush();

    	 		$request->getSession()->getFlashBag()->add('notice', 'Projet bien enregistré');

    	 		return $this->redirectToRoute('projet_invest_view', array('id' => $project->getId()));
    	 	}
    	 }

    	return $this->render('ProjetInvestAdminBundle:Admin:add.html.twig', array('form' => $form->createView(),
    	));
    }
}
