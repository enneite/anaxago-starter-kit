<?php

namespace Anaxago\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="Anaxago\CoreBundle\Repository\ProjectRepository")
 */
class Project
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
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=10, options= {"default" = "OPEN"})
     *
     * @Assert\NotBlank()
     * @Assert\Choice(choices = {"OPEN", "FUNDED"}, message = "unvalid status for project")
     */
    private $status;

    /**
     * Montant du projet
     *
     * @var float
     *
     * @ORM\Column(name="amount", type="decimal", precision=10, scale=2)
     */
    private $amount;


    /**
     * @var bool
     *
     * @ORM\Column(name="reached", type="boolean", options= {"default" = false}, nullable=true)
     */
    private $reached;


    /**
     * code ISO de la devise
     *
     * @var string
     *
     * @ORM\Column(name="currency", type="string", length=3, options= {"default" = "EUR"})
     *
     */
    private $currency;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Proposal", mappedBy="project")
     */
    protected $proposals;


    public function __construct()
    {
        $this->proposals = new ArrayCollection();
    }

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
     * Set slug
     *
     * @param string $slug
     *
     * @return Project
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Project
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Project
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return bool
     */
    public function isReached(): bool
    {
        return $this->reached;
    }

    /**
     * @param bool $reached
     */
    public function setReached(bool $reached): void
    {
        $this->reached = $reached;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }




    /**
     * ajouter des propositions de fianncement
     *
     * @param Proposal
     *
     * @return Language
     */
    public function addProposal(Proposal $proposal)
    {
        $this->proposals[] = $proposal;

        return $this;
    }

    /**
     * suprimer des propositions de financement
     *
     * @param Proposal
     */
    public function removeProposal(Proposal $proposal)
    {
        $this->proposals->removeElement($proposal);
    }

    /**
     * Get proposal.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProposals()
    {
        return $this->proposals;
    }

}

