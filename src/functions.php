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
    if (function_exists('clone')) {
        $clone = null;

        if ($clone === null) {
            $clone = static function($object, $withProperties) {
                return ('clone')($object, $withProperties);
            };
        }

        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);

        if (isset($trace[1]['class'])) {
            return $clone->bindTo(null, $trace[1]['class'])($object, $withProperties);
        }

        return $clone($object, $withProperties);
    }

    return (new Cloner($object))->cloneWith($withProperties);
}
