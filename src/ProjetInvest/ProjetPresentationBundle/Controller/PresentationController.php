<?php

namespace ProjetInvest\ProjetPresentationBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use ProjetInvest\ProjetPresentationBundle\Entity\Project;
use ProjetInvest\InvestorBundle\Entity\Donation;
use ProjetInvest\InvestorBundle\Form\DonationType;
use Symfony\Component\HttpFoundation\Request;

class PresentationController extends Controller
{
	public function indexAction($page)
	{
		if($page < 1){
			throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
		}

		$em = $this->getDoctrine()->getManager();

		// liste des projets
		$listProjects = $em->getRepository('ProjetInvestProjetPresentationBundle:Project')->findAll();

		return $this->render('ProjetInvestProjetPresentationBundle:Presentation:index.html.twig', array('listProjects' => $listProjects
		));
	}

	public function projectAction($id, Request $request)
	{
		// on récupère le repository
		$repository = $this->getDoctrine()
			->getManager()
			->getRepository('ProjetInvestProjetPresentationBundle:Project')
		;

		$donationRepository = $this->getDoctrine()
			->getManager()
			->getRepository('ProjetInvestInvestorBundle:Donation')
		;

		// on récupère le projet correspondant à id
		$project = $repository->find($id);

		// vérifier que if existe
		if(null === $project){
			throw new NotFoundHttpException("Le projet d'id".$id." n'existe pas.");
		}

		$listDonations = $donationRepository->findBy(array('project' => $project));

		$donation = new Donation;

		$donation->setProject($project);
		$donation->setInvestor($this->getUser());

		// on ajoute les champs de l'entité que l'on veut à notre formulaire
    	$form = $this->get('form.factory')->create(DonationType::class, $donation);

    	 if($request->isMethod('POST')){
    	 	$form->handleRequest($request);

    	 	if($form->isValid()){
    	 		$em = $this->getDoctrine()->getManager();
    	 		$em->persist($donation);
    	 		$em->flush();

    	 		$request->getSession()->getFlashBag()->add('notice', 'Merci de votre don');

    	 		return $this->redirectToRoute('projet_invest_view', array('id' => $project->getId()));
    	 	}
    	 }

		return $this->render('ProjetInvestProjetPresentationBundle:Presentation:project.html.twig', array(
			'project' => $project, 'form' => $form->createView(), 'listDonations' => $listDonations)
		);
	}

	public function menuAction($limit)
	{
		$em = $this->getDoctrine()->getManager();

		// liste des projets
		$listProjects = $em->getRepository('ProjetInvestProjetPresentationBundle:Project')->findAll();

		return $this->render('ProjetInvestProjetPresentationBundle:Presentation:menu.html.twig', array('listProjects' => $listProjects
		));
	}
}
