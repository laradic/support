<?php
/**
 * Part of the Sebwite PHP packages.
 *
 * License and copyright information bundled with this package in the LICENSE file
 */
namespace Laradic\Support;

/**
 * This is the class Byte.
 *
 * @package        Sebwite\Support
 * @author         Sebwite
 * @copyright      Copyright (c) 2015, Sebwite. All rights reserved
 * @mixes \ByteUnits\Metric
 */
class Byte extends \ByteUnits\Metric
{
    public function __construct($numberOfBytes, $formatWithPrecision)
    {
        parent::__construct($numberOfBytes, $formatWithPrecision);
    }

    /**
     * parse method
     *
     * @param $bytesAsString
     * @return $this
     */
    public static function parse($bytesAsString)
    {
        return parent::parse($bytesAsString);
    }
}
