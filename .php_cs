<?php

return Laradic\Support\CSFixerConfig::create()->setFinder(
    PhpCsFixer\Finder::create()
        ->in(__DIR__ . '/src')
);
