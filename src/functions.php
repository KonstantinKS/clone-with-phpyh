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
function clone_with($object, array $properties)
{
    return (new Cloner($object))->cloneWith($properties);
}
