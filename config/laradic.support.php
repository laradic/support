<?php


return [
    'dev_providers' => [
        'enabled' => env('DEV_PROVIDERS_ENABLED', true),
        'key' => env('DEV_PROVIDERS_KEY', 'app.dev.providers'),
        'when' => 'app.debug',
        'is' => true,
        //'when' => 'app.env',
        //'is' => 'local',
    ],
    'mixins' => [
        'collection' => [
            'evaluate',
            'cast',
            'toDot',
            'call',
            'pushTo'
        ],
        'arr' => [
            'merge',
            'prefix'
        ],
        // requires: gabrielelana/byte-units
        'byte_units' => [
            'bytes',
            'bytesMetric',
            'bytesBinary',
            'parseBytes',
            'parseBytesMetric',
            'parseBytesBinary',
        ],
        // requires: danielstjules/stringy
        'stringy'    => [
            'append',
            'at',
            'between',
            'camelize',
            'chars',
            'collapseWhitespace',
            'contains',
            'containsAll',
            'containsAny',
            'count',
            'countSubstr',
            'dasherize',
            'delimit',
            'endsWith',
            'endsWithAny',
            'ensureLeft',
            'ensureRight',
            'first',
            'hasLowerCase',
            'hasUpperCase',
            'htmlDecode',
            'htmlEncode',
            'humanize',
            'indexOf',
            'indexOfLast',
            'insert',
            'isAlpha',
            'isAlphanumeric',
            'isBase64',
            'isBlank',
            'isHexadecimal',
            'isJson',
            'isLowerCase',
            'isSerialized',
            'isUpperCase',
            'last',
            'length',
            'lines',
            'longestCommonPrefix',
            'longestCommonSuffix',
            'longestCommonSubstring',
            'lowerCaseFirst',
            'pad',
            'padBoth',
            'padLeft',
            'padRight',
            'prepend',
            'regexReplace',
            'removeLeft',
            'removeRight',
            'repeat',
            'replace',
            'reverse',
            'safeTruncate',
            'shuffle',
            'slugify',
            'slice',
            'split',
            'startsWith',
            'startsWithAny',
            'stripWhitespace',
            'substr',
            'surround',
            'swapCase',
            'tidy',
            'titleize',
            'toAscii',
            'toBoolean',
            'toLowerCase',
            'toSpaces',
            'toTabs',
            'toTitleCase',
            'toUpperCase',
            'trim',
            'trimLeft',
            'trimRight',
            'truncate',
            'underscored',
            'upperCamelize',
            'upperCaseFirst',

        ],
    ],
];
