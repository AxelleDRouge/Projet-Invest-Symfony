<?php

namespace ProjetInvest\InvestorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Donation
 *
 * @ORM\Table(name="donation")
 * @ORM\Entity(repositoryClass="ProjetInvest\InvestorBundle\Repository\DonationRepository")
 */
class Donation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="donation", type="integer")
     */
    private $donation;

    /**
     * @var string
     *
     * @ORM\OneToOne(targetEntity="ProjetInvest\InvestorBundle\Entity\Investor", cascade={"persist"})
     */
    private $investor;

    /**  
     * @ORM\ManyToOne(targetEntity="ProjetInvest\ProjetPresentationBundle\Entity\Project", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $project;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set donation
     *
     * @param integer $donation
     *
     * @return Donation
     */
    public function setDonation($donation)
    {
        $this->donation = $donation;

        return $this;
    }

    /**
     * Get donation
     *
     * @return int
     */
    public function getDonation()
    {
        return $this->donation;
    }

    /**
     * Set investor
     *
     * @param string $investor
     *
     * @return Donation
     */
    public function setInvestor($investor)
    {
        $this->investor = $investor;

        return $this;
    }

    /**
     * Get investor
     *
     * @return string
     */
    public function getInvestor()
    {
        return $this->investor;
    }

    /**
     * Set project
     *
     * @param string $project
     *
     * @return Donation
     */
    public function setProject($project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return string
     */
    public function getProject()
    {
        return $this->project;
    }
}
