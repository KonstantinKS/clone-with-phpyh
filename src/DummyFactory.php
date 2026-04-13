<?php

declare(strict_types=1);

namespace Kenny1911\CloneWith;

final class DummyFactory
{
    /**
     * @template T of object
     * @param T $clonedPrototype
     * @param array<string, mixed> $exceptProperties
     * @return T
     */
    public static function prepare($clonedPrototype, array $exceptProperties)
    {
        $reflObject = new \ReflectionObject($clonedPrototype);

        $dummy = $reflObject->newInstanceWithoutConstructor();

        foreach ($reflObject->getProperties() as $reflProperty) {
            if (array_key_exists($reflProperty->name, $exceptProperties)) {
                continue;
            }

            if ($reflProperty->getDeclaringClass() !== $dummy::class) {
                continue;
            }

            self::copyProperty($reflProperty, $clonedPrototype, $dummy);
        }

        $parent =  $reflObject;

        while (false !== $parent = $parent->getParentClass()) {
            foreach ($parent->getProperties(\ReflectionProperty::IS_PRIVATE) as $reflProperty) {
                if ($reflProperty->getDeclaringClass() !== $parent->name) {
                    continue;
                }

                self::copyProperty($reflProperty, $clonedPrototype, $dummy);
            }
        }

        return $dummy;
    }

    /**
     * @template T of object
     * @param T $prototype
     * @param T $target
     */
    private static function copyProperty(\ReflectionProperty $property, $prototype, $target): void
    {
        if ($property->isStatic()) {
            return;
        }

        // if (PHP_VERSION_ID >= 70400 && !$property->isInitialized($prototype)) {
        //     return;
        // }

        if (PHP_VERSION_ID >= 80400) {
            if ($property->isVirtual()) {
                return;
            }
            
            $property->setRawValue($target, $property->getRawValue($prototype));

            return;
        }

        if (PHP_VERSION_ID < 80100) {
            $property->setAccessible(true);
        }

        $property->setValue($target, $property->getValue($prototype));
    }
}
