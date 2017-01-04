<?php
/**
 * Copyright (c) 2010, Daniel Doezema
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *     * The names of the contributors and/or copyright holder may not be
 *       used to endorse or promote products derived from this software without
 *       specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL DANIEL DOEZEMA BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */
namespace Laradic\Support;

/**
 * A light-weight class for quickly benchmarking/timing/profiling PHP code.
 *
 * @copyright  Copyright (c) 2010 Daniel Doezema. (http://dan.doezema.com)
 * @license    http://dan.doezema.com/licenses/new-bsd     New BSD License
 */
class Bench
{

    /**
     * Errors that occurred during request.
     *
     * @var array
     */
    protected $errors = [ ];

    /**
     * Mark arrays.
     *
     * @var array
     */
    protected $marks = [ ];

    /**
     * Microtime of when $this->start() was called.
     *
     * @var float
     */
    protected $start = null;

    /**
     * Microtime of when $this->stop() was called.
     *
     * @var float
     */
    protected $stop = null;

    /**
     * Start timer.
     *
     * @return void;
     */
    public function start()
    {
        if ($this->start !== null) {
            $this->logError('Please call ' . __CLASS__ . '::reset() before calling ' . __CLASS__ . '::start() again.');
            return;
        }
        $this->start = microtime(true);
    }

    /**
     * Stop timer.
     *
     * @return float; -> $this->getElapsed()
     */
    public function stop()
    {
        if ($this->stop !== null) {
            $this->logError('Please call ' . __CLASS__ . '::reset() before calling ' . __CLASS__ . '::stop() again.');
            return;
        }
        $this->stop = microtime(true);
        return $this->getElapsed();
    }

    /**
     * Reset timer.
     *
     * @return void;
     */
    public function reset()
    {
        $this->marks = [ ];
        $this->start = null;
        $this->stop  = null;
    }

    /**
     * Mark a point in time.
     *
     * @param string ; The id of the mark. (e.g., 'connection_start', 'connected_success', 'connection_fail');
     *
     * @return mixed; Float, the time in seconds since last mark, or if no marks $this->start) - false, on error.
     */
    public function mark($id)
    {
        if ($this->start === null) {
            $this->logError('Please call ' . __CLASS__ . '::start() before calling ' . __CLASS__ . '::mark("' . $id . '").');
            return false;
        }
        $mark                      = [ ];
        $mark[ 'id' ]              = $id;
        $mark[ 'microtime' ]       = microtime(true);
        $mark[ 'since_start' ]     = $mark[ 'microtime' ] - $this->start;
        $mark[ 'since_last_mark' ] = count($this->marks) ? ($mark[ 'microtime' ] - $this->marks[ count($this->marks) - 1 ][ 'microtime' ]) : $mark[ 'since_start' ];
        $this->marks[]             = $mark;
        return $mark[ 'since_last_mark' ];
    }

    /**
     * Get the marks array.
     *
     * @return array;
     */
    public function getMarks()
    {
        return $this->marks;
    }

    /**
     * Get a mark by its id.
     *
     * @param string ; The id of the existing mark.
     *
     * @return mixed; array on success, false on failure.
     */
    public function getMarkById($id)
    {
        foreach ($this->marks as $mark) {
            if ($mark[ 'id' ] == $id) {
                return $mark;
            }
        }
        return false;
    }

    /**
     * Get average time (in seconds) between marks.
     *
     * @return mixed; float on success, false on failure.
     */
    public function getMarkAverage()
    {
        if (($mark_count = count($marks = $this->getMarks()))) {
            $sum = 0;
            foreach ($marks as $mark) {
                $sum += $mark[ 'since_last_mark' ];
            }
            return $sum / $mark_count;
        }
        return false;
    }

    /**
     * Get the longest mark based on [since_last_mark].
     *
     * @return mixed; array on success, false on failure.
     */
    public function getLongestMark()
    {
        if (count($marks = $this->getMarks())) {
            $longest_mark = null;
            foreach ($marks as $mark) {
                if (($longest_mark == null) || ($mark[ 'since_last_mark' ] > $longest_mark[ 'since_last_mark' ])) {
                    $longest_mark = $mark;
                }
            }
            return $longest_mark;
        }
        return false;
    }

    /**
     * Get the shortest mark based on [since_last_mark].
     *
     * @return mixed; array on success, false on failure.
     */
    public function getShortestMark()
    {
        if (count($marks = $this->getMarks())) {
            $shortest_mark = null;
            foreach ($marks as $mark) {
                if (($shortest_mark == null) || ($mark[ 'since_last_mark' ] < $shortest_mark[ 'since_last_mark' ])) {
                    $shortest_mark = $mark;
                }
            }
            return $shortest_mark;
        }
        return false;
    }

    /**
     * Get the last/latest mark.
     *
     * @return mixed; array on success, false on failure.
     */
    public function getLastMark()
    {
        if (count($this->marks)) {
            return $this->marks[ count($this->marks) - 1 ];
        }
        return false;
    }

    /**
     * Get the time (in seconds) elapsed since a specified mark.
     *
     * @param string ; The id of an existing mark.
     *
     * @return mixed; float, false on failure.
     */
    public function getElaspedSinceMark($id)
    {
        if ($mark = $this->getMarkById($id)) {
            return microtime(true) - $mark[ 'microtime' ];
        }
        return false;
    }

    /**
     * Get the time (in seconds) elapsed since the last mark() call.
     *
     * @return mixed; float, false on error.
     */
    public function getElaspedSinceLastMark()
    {
        if ($mark = $this->getLastMark()) {
            return microtime(true) - $mark[ 'microtime' ];
        }
        return false;
    }

    /**
     * Get the time elapsed (in seconds) based on context and/or parameters.
     *
     * getElapsed()
     *   if[stop() has been called] -- Time (in seconds() between start() and stop()
     *   else -- Time (in seconds) between start() and the getElapsed() call.
     *
     * getElapsed("from_mark_id", "to_mark_id") - Time (in seconds) between marks.
     *
     * @param mixed ;
     * @param mixed ;
     *
     * @return mixed; float, false on error.
     */
    public function getElapsed($from_mark_id = null, $to_mark_id = null)
    {
        $microtime = microtime(true);
        $elapsed   = false;
        if ($this->start === null) {
            $this->logError('Please call ' . __CLASS__ . '::start() before calling ' . __CLASS__ . '::getElapsed()');
            return false;
        }
        if (!$from_mark_id && !$to_mark_id) {
            $minuend = ($this->stop !== null) ? $this->stop : $microtime;
            $elapsed = $minuend - $this->start;
        } else {
            if (($mark_from = $this->getMarkById($from_mark_id)) && ($mark_to = $this->getMarkById($to_mark_id))) {
                $elapsed = abs($mark_to[ 'microtime' ] - $mark_from[ 'microtime' ]);
            } else {
                if (!$mark_from) {
                    $this->logError(__CLASS__ . '::getElapsed(): A mark with the id of "' . $from_mark_id . '" does not exist.');
                }
                if (!$mark_to) {
                    $this->logError(__CLASS__ . '::getElapsed(): A mark with the id of "' . $to_mark_id . '" does not exist.');
                }
            }
        }
        return $elapsed;
    }

    /**
     * Get statistics on what has happened since calling start();
     *
     * @return mixed; array of statistics, false on error.
     */
    public function getStats()
    {
        if ($this->start === null) {
            $this->logError('Please call ' . __CLASS__ . '::start() before calling ' . __CLASS__ . '::getStats()');
            return false;
        }
        $elapsed = $this->getElapsed();
        $stats   = [ ];
        if (count($this->getMarks())) {
            // Average Time (in seconds) Between Marks
            $stats[ 'mark_average' ] = $this->getMarkAverage();
            // The Shortest Mark
            $stats[ 'mark_shortest' ] = $this->getShortestMark();
            // The Longest Mark
            $stats[ 'mark_longest' ] = $this->getLongestMark();
        }
        // Start Microtime
        $stats[ 'start' ] = $this->start;
        // Stop Microtime
        $stats[ 'stop' ] = $this->stop ? $this->stop : null;
        // Elapsed Time (in seconds) -- Check comments of $this->getElapsed() for more info.
        $stats[ 'elapsed' ] = $elapsed;
        return $stats;
    }

    /**
     * Dumps Stats, Marks, and Errors then (by default) kills the script.
     *
     * @param bool ; if true die() -- else output.
     *
     * @return void;
     */
    public function dump($die = true)
    {
        var_dump([ 'STATISTICS' => $this->getStats(), 'MARKS' => $this->getMarks(), 'ERRORS' => $this->getErrors() ]);
        if ($die) {
            die();
        }
    }

    /**
     * Returns true if any errors occurred.
     *
     * @return bool;
     */
    public function hasErrors()
    {
        return count($this->errors) ? true : false;
    }

    /**
     * Get the errors array.
     *
     * @return array;
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Get the errors array.
     *
     * @param string ;
     *
     * @return void;
     */
    protected function logError($error)
    {
        $this->errors[] = $error;
        error_log(__CLASS__ . ': ' . $error);
    }
}
