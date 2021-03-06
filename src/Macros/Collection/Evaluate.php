<?php

namespace Laradic\Support\Macros\Collection;

use ReflectionClass;
use ReflectionMethod;
use ReflectionException;
use Symfony\Component\ExpressionLanguage\ExpressionFunction;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

/**
 * Use symfony expression language
 *
 * @param string $expression The expression
 */
class Evaluate
{
    public function __invoke()
    {
        $me = $this;
        /**
         * @param string $expression asdf
         * @param string $method
         * @param array  $vars
         */
        return function ($expression, $method = 'each', array $vars = []) use ($me) {
            return $this->{$method}(static function ($item, $key) use ($expression, $vars, $me) {
                $exl = new ExpressionLanguage();
                $me->registerFunctions($exl);
                if (is_object($item)) {
                    $me->registerClassMethods($exl, $item);
                }
                $result = $exl->evaluate($expression, array_merge($vars, compact('key', 'item')));
//                if($result instanceof Stringy){
//                    $result = $result->__toString();
//                }
                return $result;
            });
        };
    }

    public function registerFunctions(ExpressionLanguage $exl)
    {
        $fromPhp = [
            'S' => 'Laradic\Support\Helpers\stringy',
            'B' => 'Laradic\Support\Helpers\bytes',
            'C' => 'collect',
            'D' => 'Laradic\Support\Helpers\dot',
        ];
//        $exl->addFunction(new ExpressionFunction('D',null, function(...$params){
//            return;
//        }));
        foreach ($fromPhp as $expName => $phpName) {
            $exl->addFunction(ExpressionFunction::fromPhp($phpName, $expName));
        }
    }

    public function registerClassMethods(ExpressionLanguage $exl, $class)
    {
        try {
            if ( ! $class instanceof ReflectionClass) {
                $class = new ReflectionClass($class);
            }
            foreach ($class->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
                $methodName = $method->getName();
                $exl->register($method->getName(), static function (...$params) {
                    throw new \BadMethodCallException('compile not implemented');
                }, static function ($arguments, ...$params) use ($methodName) {
                    return $arguments[ 'item' ]->{$methodName}(...$params);
                });
            }

//            if (Str::contains($class->getDocComment(), '@mixin')) {
//                if (preg_match('/@mixin (.*)/', $class->getDocComment(), $matches) === 1 && isset($matches[ 1 ]) && class_exists($matches[ 1 ])) {
//                    static::registerClassMethods($exl, $matches[ 1 ]);
//                }
//            }
        }
        catch (ReflectionException $e) {
        }
    }

}
