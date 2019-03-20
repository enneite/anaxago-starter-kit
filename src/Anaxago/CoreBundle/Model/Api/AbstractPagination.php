<?php
/**
 * Created by IntelliJ IDEA.
 * User: etienne.lejariel
 * Date: 20/03/19
 * Time: 01:41
 */

namespace Anaxago\CoreBundle\Model\Api;

/**
 * classe abstraite pour la pagination
 *
 *
 * Class AbstractPagination
 * @package Anaxago\CoreBundle\Model\Api
 */
abstract class AbstractPagination implements DefinitionInterface
{
    /**
     * nb total d'éléments
     * @var int
     */
    protected $totalCount = 0;

    /**
     * numéro de page
     * @var int
     */
    protected $page = 1;

    /**
     * nb de resultats par apge
     *
     * @var int
     */
    protected $max = 10;

    /**
     * tri à effectuer
     * @var  string
     *
     */
    protected $sort = '';

    /**
     * tri ascendant descendant
     * @var
     */
    protected $order = 'ASC';

    /**
     * @var Collection
     */
    protected $items;



    /**
     * @return int
     */
    public function getTotalCount(): int
    {
        return $this->totalCount;
    }

    /**
     * @param int $totalCount
     */
    public function setTotalCount(int $totalCount): void
    {
        $this->totalCount = $totalCount;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage(int $page): void
    {
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function getMax(): int
    {
        return $this->max;
    }

    /**
     * @param int $max
     */
    public function setMax(int $max): void
    {
        $this->max = $max;
    }

    /**
     * @return string
     */
    public function getSort(): string
    {
        return $this->sort;
    }

    /**
     * @param string $sort
     */
    public function setSort(string $sort): void
    {
        $this->sort = $sort;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     */
    public function setOrder($order): void
    {
        $this->order = $order;
    }


    /**
     * @return array
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    /**
     * @param array $item
     */
    public function setItems(Collection $items): void
    {
        $this->items = $items;
    }


    /**
     * @return array
     */
    public function toArray() : array
    {
        return [
            "totalCount" => $this->getTotalCount(),
            "page" => $this->getPage(),
            "max" => $this->getMax(),
            "sort" => $this->getSort(),
            "order" => $this->getOrder()
        ];
    }


}