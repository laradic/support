<?php


use Barryvdh\Reflection\DocBlock;
use Illuminate\Filesystem\Filesystem;

$class = new ReflectionClass(Filesystem::class);
foreach ($class->getMethods() as $method) {
    $doc  = new DocBlock($method->getDocComment());
    $tags = collect($doc->getTags());
    $line = [ ' * @method ' ];

    $returnTag = head($doc->getTagsByName('return'));

    if ($returnTag) {
        $line[] = $returnTag->getType() . ' ';
    }
    $line[] = $method->getName();
    $line[] = '(';
    foreach ($method->getParameters() as $p => $param) {
        $name       = $param->getName();
        $type       = $param->getType();
        $isArray    = $param->isArray();
        $isOptional = $param->isOptional();
        if ($p > 0) {
            $line[] = ', ';
        }
        $line[] = '$' . $name;
        if ($isOptional) {
            if ($type === null) {
                $line[] = ' = null';
            }
        }
        $a = 'a';
    }
    $line[] = ') ';
    $line[] = str_repeat(' ', 8) . $doc->getShortDescription();
    echo implode('', $line) . "\n";
}
