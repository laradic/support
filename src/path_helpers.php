<?php
if(!function_exists('path_canonicalize')){
    /**
     * Canonicalizes the given path.
     * 
     * During normalization, all slashes are replaced by forward slashes ("/").
     * Furthermore, all "." and ".." segments are removed as far as possible.
     * ".." segments at the beginning of relative paths are not removed.
     * 
     * ```php
     * echo Path::canonicalize("\webmozart\puli\..\css\style.css");
     * // => /webmozart/css/style.css
     * 
     * echo Path::canonicalize("../css/./style.css");
     * // => ../css/style.css
     * ```
     * 
     * This method is able to deal with both UNIX and Windows paths.
     * @param string $path A path string.
     * @return string The canonical path.
     */
    function path_canonicalize($path){
        return forward_static_call_array([\Webmozart\PathUtil\Path::class, 'canonicalize'], func_get_args());
    }
}
if(!function_exists('path_normalize')){
    /**
     * Normalizes the given path.
     * 
     * During normalization, all slashes are replaced by forward slashes ("/").
     * Contrary to {@link canonicalize()}, this method does not remove invalid
     * or dot path segments. Consequently, it is much more efficient and should
     * be used whenever the given path is known to be a valid, absolute system
     * path.
     * 
     * This method is able to deal with both UNIX and Windows paths.
     * @param string $path A path string.
     * @return string The normalized path.
     */
    function path_normalize($path){
        return forward_static_call_array([\Webmozart\PathUtil\Path::class, 'normalize'], func_get_args());
    }
}
if(!function_exists('path_get_directory')){
    /**
     * Returns the directory part of the path.
     * 
     * This method is similar to PHP's dirname(), but handles various cases
     * where dirname() returns a weird result:
     * 
     *  - dirname() does not accept backslashes on UNIX
     *  - dirname("C:/webmozart") returns "C:", not "C:/"
     *  - dirname("C:/") returns ".", not "C:/"
     *  - dirname("C:") returns ".", not "C:/"
     *  - dirname("webmozart") returns ".", not ""
     *  - dirname() does not canonicalize the result
     * 
     * This method fixes these shortcomings and behaves like dirname()
     * otherwise.
     * 
     * The result is a canonical path.
     * @param string $path A path string.
     * @return string The canonical directory part. Returns the root directory                if the root directory is passed. Returns an empty string                if a relative path is passed that contains no slashes.                Returns an empty string if an empty string is passed.
     */
    function path_get_directory($path){
        return forward_static_call_array([\Webmozart\PathUtil\Path::class, 'getDirectory'], func_get_args());
    }
}
if(!function_exists('path_get_home_directory')){
    /**
     * Returns canonical path of the user's home directory.
     * 
     * Supported operating systems:
     * 
     *  - UNIX
     *  - Windows8 and upper
     * 
     * If your operation system or environment isn't supported, an exception is thrown.
     * 
     * The result is a canonical path.
     * @return string The canonical home directory
     */
    function path_get_home_directory(){
        return forward_static_call_array([\Webmozart\PathUtil\Path::class, 'getHomeDirectory'], func_get_args());
    }
}
if(!function_exists('path_get_root')){
    /**
     * Returns the root directory of a path.
     * 
     * The result is a canonical path.
     * @param string $path A path string.
     * @return string The canonical root directory. Returns an empty string if                the given path is relative or empty.
     */
    function path_get_root($path){
        return forward_static_call_array([\Webmozart\PathUtil\Path::class, 'getRoot'], func_get_args());
    }
}
if(!function_exists('path_get_filename')){
    /**
     * Returns the file name from a file path.
     * 
     * 
     * @param string $path The path string.
     * @return string The file name.
     */
    function path_get_filename($path){
        return forward_static_call_array([\Webmozart\PathUtil\Path::class, 'getFilename'], func_get_args());
    }
}
if(!function_exists('path_get_filename_without_extension')){
    /**
     * Returns the file name without the extension from a file path.
     * 
     * 
     * @param string      $path      The path string.
     * @param string|null $extension If specified, only that extension is cut                               off (may contain leading dot).
     * @return string The file name without extension.
     */
    function path_get_filename_without_extension($path, $extension = NULL){
        return forward_static_call_array([\Webmozart\PathUtil\Path::class, 'getFilenameWithoutExtension'], func_get_args());
    }
}
if(!function_exists('path_get_extension')){
    /**
     * Returns the extension from a file path.
     * 
     * 
     * @param string $path           The path string.
     * @param bool   $forceLowerCase Forces the extension to be lower-case                               (requires mbstring extension for correct                               multi-byte character handling in extension).
     * @return string The extension of the file path (without leading dot).
     */
    function path_get_extension($path, $forceLowerCase = NULL){
        return forward_static_call_array([\Webmozart\PathUtil\Path::class, 'getExtension'], func_get_args());
    }
}
if(!function_exists('path_has_extension')){
    /**
     * Returns whether the path has an extension.
     * 
     * 
     * @param string            $path       The path string.
     * @param string|array|null $extensions If null or not provided, checks if                                      an extension exists, otherwise                                      checks for the specified extension                                      or array of extensions (with or                                      without leading dot).
     * @param bool              $ignoreCase Whether to ignore case-sensitivity                                      (requires mbstring extension for                                      correct multi-byte character                                      handling in the extension).
     * @return bool Returns `true` if the path has an (or the specified)              extension and `false` otherwise.
     */
    function path_has_extension($path, $extensions = NULL, $ignoreCase = NULL){
        return forward_static_call_array([\Webmozart\PathUtil\Path::class, 'hasExtension'], func_get_args());
    }
}
if(!function_exists('path_change_extension')){
    /**
     * Changes the extension of a path string.
     * 
     * 
     * @param string $path      The path string with filename.ext to change.
     * @param string $extension New extension (with or without leading dot).
     * @return string The path string with new file extension.
     */
    function path_change_extension($path, $extension){
        return forward_static_call_array([\Webmozart\PathUtil\Path::class, 'changeExtension'], func_get_args());
    }
}
if(!function_exists('path_is_absolute')){
    /**
     * Returns whether a path is absolute.
     * 
     * 
     * @param string $path A path string.
     * @return bool Returns true if the path is absolute, false if it is              relative or empty.
     */
    function path_is_absolute($path){
        return forward_static_call_array([\Webmozart\PathUtil\Path::class, 'isAbsolute'], func_get_args());
    }
}
if(!function_exists('path_is_relative')){
    /**
     * Returns whether a path is relative.
     * 
     * 
     * @param string $path A path string.
     * @return bool Returns true if the path is relative or empty, false if              it is absolute.
     */
    function path_is_relative($path){
        return forward_static_call_array([\Webmozart\PathUtil\Path::class, 'isRelative'], func_get_args());
    }
}
if(!function_exists('path_make_absolute')){
    /**
     * Turns a relative path into an absolute path.
     * 
     * Usually, the relative path is appended to the given base path. Dot
     * segments ("." and "..") are removed/collapsed and all slashes turned
     * into forward slashes.
     * 
     * ```php
     * echo Path::makeAbsolute("../style.css", "/webmozart/puli/css");
     * // => /webmozart/puli/style.css
     * ```
     * 
     * If an absolute path is passed, that path is returned unless its root
     * directory is different than the one of the base path. In that case, an
     * exception is thrown.
     * 
     * ```php
     * Path::makeAbsolute("/style.css", "/webmozart/puli/css");
     * // => /style.css
     * 
     * Path::makeAbsolute("C:/style.css", "C:/webmozart/puli/css");
     * // => C:/style.css
     * 
     * Path::makeAbsolute("C:/style.css", "/webmozart/puli/css");
     * // InvalidArgumentException
     * ```
     * 
     * If the base path is not an absolute path, an exception is thrown.
     * 
     * The result is a canonical path.
     * @param string $path     A path to make absolute.
     * @param string $basePath An absolute base path.
     * @return string An absolute path in canonical form.
     */
    function path_make_absolute($path, $basePath){
        return forward_static_call_array([\Webmozart\PathUtil\Path::class, 'makeAbsolute'], func_get_args());
    }
}
if(!function_exists('path_make_relative')){
    /**
     * Turns a path into a relative path.
     * 
     * The relative path is created relative to the given base path:
     * 
     * ```php
     * echo Path::makeRelative("/webmozart/style.css", "/webmozart/puli");
     * // => ../style.css
     * ```
     * 
     * If a relative path is passed and the base path is absolute, the relative
     * path is returned unchanged:
     * 
     * ```php
     * Path::makeRelative("style.css", "/webmozart/puli/css");
     * // => style.css
     * ```
     * 
     * If both paths are relative, the relative path is created with the
     * assumption that both paths are relative to the same directory:
     * 
     * ```php
     * Path::makeRelative("style.css", "webmozart/puli/css");
     * // => ../../../style.css
     * ```
     * 
     * If both paths are absolute, their root directory must be the same,
     * otherwise an exception is thrown:
     * 
     * ```php
     * Path::makeRelative("C:/webmozart/style.css", "/webmozart/puli");
     * // InvalidArgumentException
     * ```
     * 
     * If the passed path is absolute, but the base path is not, an exception
     * is thrown as well:
     * 
     * ```php
     * Path::makeRelative("/webmozart/style.css", "webmozart/puli");
     * // InvalidArgumentException
     * ```
     * 
     * If the base path is not an absolute path, an exception is thrown.
     * 
     * The result is a canonical path.
     * @param string $path     A path to make relative.
     * @param string $basePath A base path.
     * @return string A relative path in canonical form.
     */
    function path_make_relative($path, $basePath){
        return forward_static_call_array([\Webmozart\PathUtil\Path::class, 'makeRelative'], func_get_args());
    }
}
if(!function_exists('path_is_local')){
    /**
     * Returns whether the given path is on the local filesystem.
     * 
     * 
     * @param string $path A path string.
     * @return bool Returns true if the path is local, false for a URL.
     */
    function path_is_local($path){
        return forward_static_call_array([\Webmozart\PathUtil\Path::class, 'isLocal'], func_get_args());
    }
}
if(!function_exists('path_get_longest_common_base_path')){
    /**
     * Returns the longest common base path of a set of paths.
     * 
     * Dot segments ("." and "..") are removed/collapsed and all slashes turned
     * into forward slashes.
     * 
     * ```php
     * $basePath = Path::getLongestCommonBasePath(array(
     *     '/webmozart/css/style.css',
     *     '/webmozart/css/..'
     * ));
     * // => /webmozart
     * ```
     * 
     * The root is returned if no common base path can be found:
     * 
     * ```php
     * $basePath = Path::getLongestCommonBasePath(array(
     *     '/webmozart/css/style.css',
     *     '/puli/css/..'
     * ));
     * // => /
     * ```
     * 
     * If the paths are located on different Windows partitions, `null` is
     * returned.
     * 
     * ```php
     * $basePath = Path::getLongestCommonBasePath(array(
     *     'C:/webmozart/css/style.css',
     *     'D:/webmozart/css/..'
     * ));
     * // => null
     * ```
     * @param array $paths A list of paths.
     * @return string|null The longest common base path in canonical form or                     `null` if the paths are on different Windows                     partitions.
     */
    function path_get_longest_common_base_path(array $paths){
        return forward_static_call_array([\Webmozart\PathUtil\Path::class, 'getLongestCommonBasePath'], func_get_args());
    }
}
if(!function_exists('path_join')){
    /**
     * Joins two or more path strings.
     * 
     * The result is a canonical path.
     * @param string[]|string $paths Path parts as parameters or array.
     * @return string The joint path.
     */
    function path_join($paths){
        return forward_static_call_array([\Webmozart\PathUtil\Path::class, 'join'], func_get_args());
    }
}
if(!function_exists('path_is_base_path')){
    /**
     * Returns whether a path is a base path of another path.
     * 
     * Dot segments ("." and "..") are removed/collapsed and all slashes turned
     * into forward slashes.
     * 
     * ```php
     * Path::isBasePath('/webmozart', '/webmozart/css');
     * // => true
     * 
     * Path::isBasePath('/webmozart', '/webmozart');
     * // => true
     * 
     * Path::isBasePath('/webmozart', '/webmozart/..');
     * // => false
     * 
     * Path::isBasePath('/webmozart', '/puli');
     * // => false
     * ```
     * @param string $basePath The base path to test.
     * @param string $ofPath   The other path.
     * @return bool Whether the base path is a base path of the other path.
     */
    function path_is_base_path($basePath, $ofPath){
        return forward_static_call_array([\Webmozart\PathUtil\Path::class, 'isBasePath'], func_get_args());
    }
}