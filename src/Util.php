<?php
/**
 * Part of the Laradic PHP packages.
 *
 * License and copyright information bundled with this package in the LICENSE file
 */
namespace Laradic\Support;

use Symfony\Component\Process\Process;

final class Util
{
    /**
     * Very simple 'template' parser. Replaces (for example) {name} with the value of $vars['name'] in strings
     *
     * @param        $str
     * @param array  $vars
     * @param string $openDelimiter
     * @param string $closeDelimiter
     *
     * @return string
     *
     * @example
     * <?php
     * $result = Util::template('This is the best template parser. Created by {developerName}', ['developerName' => 'Radic']);
     * echo $result; // This is the best template parser. Created by Radic
     */
    public static function template($str, array $vars = [ ], $openDelimiter = '{', $closeDelimiter = '}')
    {
        foreach ($vars as $k => $var) {
            if (is_array($var)) {
                $str = static::template($str, $var);
            } elseif (is_string($var)) {
                $str = Str::replace($str, $openDelimiter . $k . $closeDelimiter, $var);
            }
        }

        return $str;
    }


    public static function recursiveArrayStringReplace($items, $vars = [])
    {
        foreach ($items as $k => &$v) {
            if (is_array($v)) {
                $v = static::recursiveArrayStringReplace($v, $vars);
            } elseif (is_string($v)) {
                foreach ($vars as $vkey => $vval) {
                    $v = str_replace("{$vkey}", $vval, $v);
                }
            }
        }
        return $items;
    }



    public static function randomChance($percent = 50)
    {
        return mt_rand(0, 100) > 100 - $percent;
    }

    public static function shell($commands, array $opts = [ ])
    {
        //$cwd = null, array $env = null, $input = null, $timeout = 60, array $options = array()
        if (is_array($commands)) {
            $procs = [ ];
            foreach ($commands as $command) {
                $procs[] = static::shell($command, $opts);
            }

            return $procs;
        }


        $process = new Process($commands);
        $options = array_replace([
            'type'     => 'sync', // sync|async
            'cwd'      => null,
            'env'      => null,
            'timeout'  => 60,
            'callback' => null,
            'output'   => true,
        ], $opts);

        $options[ 'cwd' ] !== null && $process->setWorkingDirectory($options[ 'cwd' ]);
        $options[ 'env' ] !== null && $process->setEnv($options[ 'env' ]);
        is_int($options[ 'timeout' ]) && $process->setTimeout($options[ 'timeout' ]);

        if ($options[ 'output' ] === true) {
            $process->enableOutput();
        } else {
            $process->disableOutput();
        }

        $type = $options[ 'type' ];
        if ($type === 'sync') {
            $process->run($options[ 'callback' ]);
        } elseif ($type === 'async') {
            $process->start();
        }

        return $process;
    }

    /**
     * Get the class name from a php file
     *
     * @param string $filePath
     *
     * @return string|null
     */
    public static function getClassNameFromFile($filePath)
    {
        $tokens = token_get_all(file_get_contents($filePath));


        for ($i = 0; $i < count($tokens); $i++) {
            if ($tokens[ $i ][ 0 ] === T_TRAIT || $tokens[ $i ][ 0 ] === T_INTERFACE) {
                return;
            }
            if ($tokens[ $i ][ 0 ] === T_CLASS) {
                for ($j = $i + 1; $j < count($tokens); $j++) {
                    if ($tokens[ $j ] === '{') {
                        return $tokens[ $i + 2 ][ 1 ];
                    }
                }
            }
        }
    }

    /**
     * Get the namespace of the php file
     *
     * @param $filePath
     *
     * @return string|null
     */
    public static function getNamespaceFromFile($filePath)
    {
        $namespace = '';
        $tokens    = token_get_all(file_get_contents($filePath));
        for ($i = 0; $i < count($tokens); $i++) {
            if ($tokens[ $i ][ 0 ] === T_NAMESPACE) {
                for ($j = $i + 1; $j < count($tokens); $j++) {
                    if ($tokens[ $j ][ 0 ] === T_STRING) {
                        $namespace .= '\\' . $tokens[ $j ][ 1 ];
                    } else {
                        if ($tokens[ $j ] === '{' || $tokens[ $j ] === ';') {
                            return $namespace;
                        }
                    }
                }
            }
        }
    }

    /**
     * Get the namespace, classes, interfaces and traits of the php file
     *
     * @param $filePath
     *
     * @return array
     */
    public static function getPhpDefinitionsFromFile($filePath)
    {
        $classes    = [ ];
        $traits     = [ ];
        $interfaces = [ ];

        $fp    = fopen($filePath, 'r');
        $trait = $interface = $class = $namespace = $buffer = '';
        $i     = 0;
        while (!$class) {
            if (feof($fp)) {
                break;
            }

            $buffer .= fread($fp, 512);
            $tokens = token_get_all($buffer);

            if (strpos($buffer, '{') === false) {
                continue;
            }

            for (; $i < count($tokens); $i++) {
                if ($tokens[ $i ][ 0 ] === T_NAMESPACE) {
                    for ($j = $i + 1; $j < count($tokens); $j++) {
                        if ($tokens[ $j ][ 0 ] === T_STRING) {
                            $namespace .= '\\' . $tokens[ $j ][ 1 ];
                        } else {
                            if ($tokens[ $j ] === '{' || $tokens[ $j ] === ';') {
                                break;
                            }
                        }
                    }
                }

                if ($tokens[ $i ][ 0 ] === T_CLASS) {
                    for ($j = $i + 1; $j < count($tokens); $j++) {
                        if ($tokens[ $j ] === '{') {
                            $class     = $tokens[ $i + 2 ][ 1 ];
                            $classes[] = $class;
                        }
                    }
                }

                if ($tokens[ $i ][ 0 ] === T_INTERFACE) {
                    for ($j = $i + 1; $j < count($tokens); $j++) {
                        if ($tokens[ $j ] === '{') {
                            $interface    = $tokens[ $i + 2 ][ 1 ];
                            $interfaces[] = $interface;
                        }
                    }
                }

                if ($tokens[ $i ][ 0 ] === T_TRAIT) {
                    for ($j = $i + 1; $j < count($tokens); $j++) {
                        if ($tokens[ $j ] === '{') {
                            $trait    = $tokens[ $i + 2 ][ 1 ];
                            $traits[] = $trait;
                        }
                    }
                }
            }
        }

        return compact('namespace', 'classes', 'traits', 'interfaces');
    }
}
