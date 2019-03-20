<?php
/**
 * Created by IntelliJ IDEA.
 * User: etienne.lejariel
 * Date: 20/03/19
 * Time: 01:22
 */

namespace Anaxago\CoreBundle\Model\Api;

/**
 * Proposition de financement exposée par l'API
 *
 * Class Proposal
 * @package Anaxago\CoreBundle\Model\Api
 */
class Proposal implements DefinitionInterface
{
    /**
     * ID de la proposition de financement
     *
     * @var int
     */
    protected $id;

    /**
     * montant de la proposition de financement
     *
     * @var float
     */
    protected $amount;

    /**
     * devise de la proposition de financement
     *
     * @var string
     */
    protected $currency;

    /**
     * Projet sujet au financement
     *
     * @var Project
     */
    protected $project;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return float
     */
    public function getAmount(): ?float
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
     * @return string
     */
    public function getCurrency(): ?string
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
     * @return Project
     */
    public function getProject(): ?Project
    {
        return $this->project;
    }

    /**
     * @param Project $project
     */
    public function setProject(Project $project): void
    {
        $this->project = $project;
    }

    /**
     * @return array
     */
    public function toArray() : array
    {
        return [
            'id' => $this->getId(),
            'amount' => $this->getAmount(),
            'currency' => $this->getCurrency(),
            'project' => $this->getProject()->toArray(),

        ];
    }


}