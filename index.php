<?php

    declare(strict_types = 1);

    require_once __DIR__ . "/vendor/autoload.php";

    // $minifier = new App\Minifier("duck");

    $grammar = \App\Grammar::parseInputs($argv);
