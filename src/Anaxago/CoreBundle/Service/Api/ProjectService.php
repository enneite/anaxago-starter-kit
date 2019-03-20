<?php
/**
 * Created by IntelliJ IDEA.
 * User: etienne.lejariel
 * Date: 20/03/19
 * Time: 01:38
 */

namespace Anaxago\CoreBundle\Service\Api;


use Anaxago\CoreBundle\Model\Api\Collection;
use Anaxago\CoreBundle\Model\Api\Mapping;
use Anaxago\CoreBundle\Model\Api\Project;
use Anaxago\CoreBundle\Model\Api\ProjectPagination;

class ProjectService
{

    protected $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function listProjects()
    {
        $pagination = new ProjectPagination();

        $pagination->setTotalCount($this->repository->count());

        $entities = $this->repository->findAll();
        $collection = new Collection();
        foreach ($entities as $entity) {
            $item = new Project();
            $item = Mapping::buildFromObject($item, $entity);
            $collection->push($item);
        }
        $pagination->setItems($collection);


        return $pagination->toArray();
    }

    public function readProject(int $id)
    {
        return [];
    }
}