<?php
/**
 * Created by IntelliJ IDEA.
 * User: etienne.lejariel
 * Date: 20/03/19
 * Time: 22:02
 */

namespace Anaxago\CoreBundle\Model\Api;


class Collection implements DefinitionInterface,  \IteratorAggregate, \Countable
{
    /**
     * @var array
     */
    protected $items = array();

    /**
     * @param $item
     */
    public function push($item)
    {
        $this->items[] = $item;
    }

    /**
     * return items in an array (array can be json encoded)
     *
     * @return array
     */
    public function toArray() : array
    {
        $a = [];
        foreach ($this->items as $item) {
            if($item instanceof DefinitionInterface) {
                array_push($a, $item->toArray());
            }
            else if(is_object($item)) {
                array_push($a, (array) $item);
            }
            else {
                array_push($a, $item);
            }

        }

        return $a;
    }

    /**
     * items getter
     *
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * items setter
     *
     * @param array $items
     * @return $this
     */
    public function setItems(array $items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->items);
    }

    /**
     * @return \ArrayIterator|\Traversable
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }
}