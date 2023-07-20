<?php

namespace second;

interface ISession
{
    public static function start(): void;
    public static function end(): void;

}