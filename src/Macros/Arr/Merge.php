<?php

namespace Laradic\Support\Macros\Arr;

use Illuminate\Support\Arr;

class Merge
{

    public function __invoke()
    {
        return function ($arr1, $arr2, $unique = true) {
            if (empty($arr1)) {
                return $arr2;
            }

            if (empty($arr2)) {
                return $arr1;
            }

            foreach ($arr2 as $key => $value) {
                if (\is_int($key)) {
                    if ( ! $unique || ! \in_array($value, $arr1, true)) {
                        $arr1[] = $value;
                    }
                } elseif (Arr::accessible($arr2[ $key ])) {
                    if ( ! isset($arr1[ $key ])) {
                        $arr1[ $key ] = [];
                    }
                    if (Arr::accessible($arr1[ $key ])) {
                        $value = Merge::__invoke()($arr1[ $key ], $value, $unique);
                    }

                    if (\is_int($key)) {
                        $arr1[] = $unique ? array_unique($value) : $value;
                    } else {
                        $arr1[ $key ] = $value;
                    }
                } else {
                    $arr1[ $key ] = $value;
                }
            }
            return $arr1;
        };
    }

}
