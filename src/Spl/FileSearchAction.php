<?php

namespace Laradic\Support\Spl;

use Illuminate\Support\Str;
use Illuminate\Support\Arr;

/**
 * @method $this returnFirstMatch(bool $value = true)
 * @method $this matchesExpression(string|string[] $expression)
 * @method $this matchesStr(string|string[] $str)
 *
 */
class FileSearchAction extends FileAction
{
    public function __construct(...$attributeArrays)
    {
        parent::__construct([
            'returnFirstMatch'  => false,
            'matchesExpression' => null,
            'matchesStr'        => null,
        ], ...$attributeArrays);
    }

    /**
     * @return int|int[] lines
     */
    public function getResult()
    {
        $data = $this->toArray();
        $file = $data[ 'file' ];
        $file->seek($data[ 'startAt' ]);
        $result = [];
        while ($file->eof() === false || $file->key() <= 1) {
            $currentLine = $file->key() ;
            $str         = $file->current();
            $isMatch     = false;
            if ($data[ 'matchesExpression' ]) {
                foreach(Arr::wrap($data[ 'matchesExpression' ]) as $pattern){
                    $isMatch = $isMatch ?: preg_match($pattern,$str) === 1;
                }
            }
            if ($data[ 'matchesStr' ]) {
                $isMatch = $isMatch ?: Str::is($data[ 'matchesStr' ], $str);
            }
            if ($isMatch && $data[ 'returnFirstMatch' ]) {
                return $currentLine;
            }
            if($isMatch){
                $result[] = $currentLine;
            }

            if ($data[ 'direction' ] === static::DIRECTION_UPWARDS) {
                $currentLine--;
            } else {
                $currentLine++;
            }
            if($currentLine < 0){
                break;
            }
            $file->seek($currentLine);
        }
        return $result;
    }

    /**
     * @return array {
     *      returnFirstMatch: bool,
     *      matchesExpression: string,
     *               matchesStr: string
     * }
     */
    public function toArray()
    {
        return parent::toArray();
    }
}