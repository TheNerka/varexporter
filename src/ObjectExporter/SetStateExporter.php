<?php

declare(strict_types=1);

namespace Brick\VarExporter\ObjectExporter;

use Brick\VarExporter\Internal\ClassInfo;
use Brick\VarExporter\ObjectExporter;

/**
 * Handles instances of classes with a __set_state() method.
 */
class SetStateExporter extends ObjectExporter
{
    /**
     * {@inheritDoc}
     */
    public function supports($object, ClassInfo $classInfo) : bool
    {
        return $classInfo->hasSetState;
    }

    /**
     * {@inheritDoc}
     */
    public function export($object, ClassInfo $classInfo, int $nestingLevel) : string
    {
        $vars = $classInfo->getObjectVars($object);

        return '\\' . get_class($object) . '::__set_state(' . $this->varExporter->exportArray($vars, $nestingLevel) . ')';
    }
}