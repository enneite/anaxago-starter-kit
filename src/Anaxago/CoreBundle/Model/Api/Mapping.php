<?php
/**
 * Created by IntelliJ IDEA.
 * User: etienne.lejariel
 * Date: 20/03/19
 * Time: 22:58
 */

namespace Anaxago\CoreBundle\Model\Api;

use Symfony\Component\Validator\Constraints\DateTime;

class Mapping
{
    /**
     * build the resource from an associative array.
     *
     * @param ResourceInterface $model
     * @param $data
     *
     * @return ResourceInterface
     */
    public static function buildFromArray(DefinitionInterface $model, array $data)
    {
        $reflection = new \ReflectionClass($model);
        $properties = $reflection->getProperties(\ReflectionProperty::IS_PROTECTED);
        foreach ($properties as $property) {
            $setter = 'set' . ucfirst($property->getName());
            $getter = 'get' . ucfirst($property->getName());

            if (array_key_exists($property->getName(), $data)) {
                $value     = $data[$property->getName()];
                $attribute = $model->{$getter}();
                if (is_array($value) && $attribute instanceof  ModelInterface) {
                    self::buildFromArray($attribute, $value);
                } else {
                    $model->{$setter}($value);
                }
            }
        }

        return $model;
    }

    /**
     * build the resource from an model object using his getters.
     *
     *
     * @param ResourceInterface $model
     * @param $object
     *
     * @return ResourceInterface
     */
    public static function buildFromObject(DefinitionInterface $model, $object, $dateFormat = 'Y-m-d')
    {
        $reflection = new \ReflectionClass($model);
        $properties = $reflection->getProperties(\ReflectionProperty::IS_PROTECTED);

        $reflectionModel = new \ReflectionClass($object);

        foreach ($properties as $property) {
            $setter = 'set' . ucfirst($property->getName());
            $getter = 'get' . ucfirst($property->getName());

            try {
                $method = $reflectionModel->getMethod($getter);

                $value     = $object->{$getter}();
                $attribute = $model->{$getter}();
                if ($value instanceof \DateTime) { // format special pour les dates ...
                    $model->{$setter}($value->format($dateFormat));
                }
                else if (is_object($value) && $model->{$getter}() instanceof  ModelInterface) {
                    self::buildFromObject($attribute, $value, $dateFormat);
                }
                else if(is_array($value)) { // : can only map array of scalar => @todo map array of object
                    $collection = new Collection();
                    $collection->setItems($value);
                    $model->{$setter}($collection);
                }
                else {
                    $model->{$setter}($value);
                }
            }
            catch (\ReflectionException $e) {
                // nothing to do!
            }
        }

        return $model;
    }
}