<?php

namespace Tests\Unit;

trait MockBuilder
{
    private function getMock(string $className)
    {
        return $this
            ->getMockBuilder($className)
            ->disableOriginalConstructor()
            ->getMock();
    }

    private function getMockWithMethods(string $className, array $methods)
    {
        return $this
            ->getMockBuilder($className)
            ->setMethods($methods)
            ->disableOriginalConstructor()
            ->getMock();
    }
}
