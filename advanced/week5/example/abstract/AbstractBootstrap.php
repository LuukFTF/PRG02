<?php

/**
 * Class AbstractBootstrap
 */
abstract class AbstractBootstrap
{
    protected $state;

    abstract public function run(): void;

    public function setup(): void
    {
        // TODO: Implement setup() method.
    }
}
