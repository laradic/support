<?php
/**
 * Part of the Laradic PHP packages.
 *
 * License and copyright information bundled with this package in the LICENSE file
 */

namespace Laradic\Support;

/**
 * This is the class Byte.
 *
 * @author         Laradic
 * @copyright      Copyright (c) 2015, Laradic. All rights reserved
 * @mixes \ByteUnits\Metric
 * @codeCoverageIgnore
 */
class Byte extends \ByteUnits\Metric
{
    public function __construct($numberOfBytes, $formatWithPrecision)
    {
        parent::__construct($numberOfBytes, $formatWithPrecision);
    }

    /**
     * parse method.
     *
     * @param $bytesAsString
     *
     * @return $this
     */
    public static function parse($bytesAsString)
    {
        return parent::parse($bytesAsString);
    }
}
