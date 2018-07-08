<?php

namespace ProjetInvest\InvestorBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use ProjetInvest\InvestorBundle\Entity\Donation;
use ProjetInvest\InvestorBundle\Entity\Investor;
use Symfony\Component\HttpFoundation\Request;

class ProfilController extends Controller
{
	public function profilAction(Request $request)
	{

		// on récupère le repository
		$repository = $this->getDoctrine()
			->getManager()
			->getRepository('ProjetInvestInvestorBundle:Investor')
		;

		$donationRepository = $this->getDoctrine()
			->getManager()
			->getRepository('ProjetInvestInvestorBundle:Donation')
		;

		// on récupère le projet correspondant à id
		$investor = $repository->find($this->getUser()->getId());

		//on récupère les donations faites par l'investisseur
		$listDonations = $donationRepository->findBy(array('investor' => $investor));

		return $this->render('ProjetInvestInvestorBundle:Profil:profil.html.twig', array(
			'investor' => $investor, 'listDonations' => $listDonations)
		);

	}
}