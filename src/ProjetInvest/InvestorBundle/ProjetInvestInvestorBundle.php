<?php

namespace ProjetInvest\InvestorBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ProjetInvestInvestorBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
