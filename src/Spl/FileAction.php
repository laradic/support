<?php

namespace Laradic\Support\Spl;

use SplFileObject;
use Illuminate\Support\Fluent;

/**
 * @method $this startAt(int $lineNumber)
 * @method $this file(SplFileObject $file)
 */
class FileAction extends Fluent
{
    const DIRECTION_UPWARDS = 'upwards';
    const DIRECTION_DOWNWARDS = 'downwards';

    public function __construct(...$attributeArrays)
    {
        parent::__construct(array_replace_recursive([
            'direction' => static::DIRECTION_DOWNWARDS,
            'startAt'   => 0,
        ], ...$attributeArrays));
    }

    public static function make(SplFileObject $file)
    {
        return (new static(compact('file')));
    }

    /** @return $this */
    public function upwards()
    {
        return $this->direction(static::DIRECTION_UPWARDS);
    }

    /** @return $this */
    public function downwards()
    {
        return $this->direction(static::DIRECTION_DOWNWARDS);
    }

    /**
     * @return array {
     *      startAt: int,
     *      file: \SplFileObject,
     *               direction: string
     * }
     */
    public function toArray()
    {
        return parent::toArray();
    }


}