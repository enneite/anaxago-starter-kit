<?php
/**
 * Created by IntelliJ IDEA.
 * User: etienne.lejariel
 * Date: 20/03/19
 * Time: 21:46
 */

namespace Anaxago\CoreBundle\Model\Api;


interface DefinitionInterface
{
    /**
     * @return array
     */
    public function toArray() : array;
}