<?php
/**
 * Created by IntelliJ IDEA.
 * User: etienne.lejariel
 * Date: 20/03/19
 * Time: 01:21
 */

namespace Anaxago\CoreBundle\Model\Api;

/**
 * Projet exposé par l'API
 *
 * Class Project
 * @package Anaxago\CoreBundle\Model\Api
 */
class Project
{
    /**
     * ID du projet
     *
     * @var int
     */
    protected $id;

    /**
     * statut du projet
     *
     * @var string
     */
    protected $status;

    /**
     * slug du projet
     *
     * @var string
     */
    protected $slug;

    /**
     * descrition du projet
     *
     * @var string
     */
    protected $description;

    /**
     *  titre du projet
     *
     * @var string
     */
    protected $title;

    /**
     * @return int
     */
    public function getId(): int
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
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }



}