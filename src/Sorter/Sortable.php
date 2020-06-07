<?php

/**
 * Part of the Laradic PHP Packages.
 *
 * Copyright (c) 2017. Robin Radic.
 *
 * The license can be found in the package and online at https://laradic.mit-license.org.
 *
 * @copyright Copyright 2017 (c) Robin Radic
 * @license https://laradic.mit-license.org The MIT License
 */
namespace Laradic\Support\Sorter;


/**
 * Interface Sortable
 *
 * @package        Laradic\Support
 * @author         Laradic Dev Team
 * @copyright      Copyright (c) 2015, Laradic
 * @license        https://tldrlegal.com/license/mit-license MIT License
 */
interface Sortable
{

    /**
     * add an array of items for sorting
     *
     * @return void
     */
    public function add(array $item, $allowNumericKey = false);

    /**
     * add a single item for sorting
     *
     * @return void
     */
    public function addItem($item, $dependsOn = null);

    /**
     * sort the items
     *
     * @return array|mixed
     */
    public function sort();

    /**
     * check if item2 is a dependent of item
     *
     * @param  string|mixed $item
     * @param  string|mixed $item2
     *
     * @return boolean
     */
    public function isDependent($item, $item2);

    /**
     * check if item has dependents
     *
     * @param  string|mixed $item
     *
     * @return boolean
     */
    public function hasDependents($item);

    /**
     * check if item has missing dependents
     *
     * @param  string|mixed $item
     *
     * @return boolean
     */
    public function hasMissing($item);

    /**
     * check if an item is a missing dependency
     *
     * @param  string|mixed $dep
     *
     * @return boolean
     */
    public function isMissing($dep);

    /**
     * check if an item has circular dependents
     *
     * @param  string|mixed $item
     *
     * @return boolean
     */
    public function hasCircular($item);

    /**
     * check if an item is a circular dependency
     *
     * @param  string|mixed $dep
     *
     * @return boolean
     */
    public function isCircular($dep);

    /**
     * get circular item list
     *
     * @return array|mixed
     */
    public function getCircular();

    /**
     * get missing item list
     *
     * @return array|mixed
     */
    public function getMissing();

    /**
     * get hit count list
     *
     * @return array|mixed
     */
    public function getHits();
}
