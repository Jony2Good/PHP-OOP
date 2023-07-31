<?php

namespace app\Contracts;
interface IController
{
    public function setEnvironment(array $urlParams): void;

    public function render(): string;
}