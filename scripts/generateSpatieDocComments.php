<?php

use Illuminate\Support\Str;
use Webmozart\PathUtil\Path;
use Barryvdh\Reflection\DocBlock;
use Illuminate\Filesystem\Filesystem;

$paths = glob(dirname(__DIR__) . '/src/Spatie/CollectionMacros/Macros/*', GLOB_NOSORT | GLOB_BRACE);
foreach ($paths as $path) {
    $name  = Path::getFilenameWithoutExtension($path);
    $class = new ReflectionClass('Laradic\Support\Spatie\CollectionMacros\Macros\\' . $name);
    $methodName = Str::camel($class->getShortName());
    if ( ! is_string($class->getDocComment())) {
        echo " * @method {$methodName}()\n";
        continue;
    }
    $doc  = new DocBlock($class->getDocComment());
    $line = [ ' * @method ' ];
    /** @var \Barryvdh\Reflection\DocBlock\Tag\ParamTag[]|\Illuminate\Support\Collection $params */
    $params    = collect($doc->getTagsByName('param'));
    $returnTag = head($doc->getTagsByName('return'));

    $desc = $doc->getShortDescription() . PHP_EOL . $doc->getLongDescription()->getContents();

    $line[] = $methodName;
    $line[] = '(';
    foreach($params as $p => $param){
        $c=$param->getContent();
        $name       = $param->getName();
        $type       = $param->getType();
//        $isArray    = $param->isArray();
//        $isOptional = $param->isOptional();
        if ($p > 0) {
            $line[] = ', ';
        }
        $line[] = $param->getContent();
//        if ($isOptional) {
//            if ($type === null) {
//                $line[] = ' = null';
//            }
//        }

    }
    $line[] = ')';
    $line[] = str_repeat(' ', 8) . str_replace("\n",'', $doc->getShortDescription() . PHP_EOL . $doc->getLongDescription()->getContents());
    echo implode('', $line) . "\n";
}
