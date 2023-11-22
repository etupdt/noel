
<?php

class Entity {

    function clone() {

        $retour = clone $this;

        foreach ((new ReflectionClass($this))->getProperties() as $property) {

            if ($property->gettype() !== null) {
                $name = $property->getName();
                if (isset($this->$name)) {
                    $property->setValue($retour, $this->$name->clone());
                }
            }

        }

        return $retour;

    }

}
