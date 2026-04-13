<?php

declare(strict_types=1);

namespace Kenny1911\CloneWith;

use Kenny1911\CloneWith\Exception\CloneException;

/**
 * @template T of object
 * @param T $object
 *
 * @return T
 *
 * @throws CloneException
 */
function clone_with($object, array $withProperties = [])
{
    $clone = null;

    if ($clone === null) {
        if (false && function_exists('clone')) {
            $clone = static function($object, array $properties) {
                return ('clone')($object, $properties);
            };
        } else {
            $clone = static function($object, array $properties) {
                $dummy = DummyFactory::prepare(clone $object, $properties);

                foreach ($properties as $name => $value) {
                    $dummy->{$name} = $value;
                }

                return $dummy;
            };
        }
    }

    $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);

    if (isset($trace[1]['class'])) {
        return $clone->bindTo(null, $trace[1]['class'])($object, $withProperties);
    }

    return $clone($object, $withProperties);
}
