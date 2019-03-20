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

    /**
     * Liste paginée des projets
     *
     * @param $page
     * @param $max
     * @return array
     */
    public function listProjects($page, $max)
    {
        $pagination = new ProjectPagination();

        $pagination->setTotalCount($this->repository->count());

        $entities = $this->repository->findAll($page, $max);
        $collection = new Collection();
        foreach ($entities as $entity) {
            $item = new Project();
            $item = Mapping::buildFromObject($item, $entity);
            $collection->push($item);
        }
        $pagination->setItems($collection);
        $pagination->setMax($max);
        $pagination->setPage($page);


        return $pagination->toArray();
    }

    /**
     * lecture d'un projet par son ID
     *
     *
     * @param int $id
     * @return mixed
     */
    public function readProject(int $id)
    {
        $entity = $this->repository->find($id);
        $project = new Project();
        $project = Mapping::buildFromObject($project, $entity);

        return $project->toArray();
    }
}