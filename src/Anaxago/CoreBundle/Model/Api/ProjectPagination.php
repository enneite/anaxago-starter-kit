<?php
/**
 * Created by IntelliJ IDEA.
 * User: etienne.lejariel
 * Date: 20/03/19
 * Time: 01:46
 */

namespace Anaxago\CoreBundle\Model\Api;


class ProjectPagination extends AbstractPagination
{
    public function __construct()
    {
        $this->items = new Collection();
    }
    /**
     * @return array
     */
    public function toArray() : array
    {
        return array_merge(parent::toArray(), ['items' =>$this->getItems()->toArray()]);
    }
}