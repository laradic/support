<?php

namespace Laradic\Support;


use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Finder\SplFileInfo;


/**
 * @method static bool exists($path)         Determine if a file or directory exists.
 * @method static string get($path, $lock = null)         Get the contents of a file.
 * @method static string sharedGet($path)         Get contents of a file with shared access.
 * @method static mixed getRequire($path)         Get the returned value of a file.
 * @method static mixed requireOnce($file)         Require the given file once.
 * @method static string hash($path)         Get the MD5 hash of the file at the given path.
 * @method static int|bool put($path, $contents, $lock = null)         Write the contents of a file.
 * @method static void replace($path, $content)         Write the contents of a file, replacing it atomically if it already exists.
 * @method static int prepend($path, $data)         Prepend to a file.
 * @method static int append($path, $data)         Append to a file.
 * @method static mixed chmod($path, $mode = null)         Get or set UNIX mode of a file or directory.
 * @method static bool delete($paths)         Delete the file at a given path.
 * @method static bool move($path, $target)         Move a file to a new location.
 * @method static bool copy($path, $target)         Copy a file to a new location.
 * @method static void link($target, $link)         Create a hard link to the target file or directory.
 * @method static string name($path)         Extract the file name from a file path.
 * @method static string basename($path)         Extract the trailing name component from a file path.
 * @method static string dirname($path)         Extract the parent directory from a file path.
 * @method static string extension($path)         Extract the file extension from a file path.
 * @method static string type($path)         Get the file type of a given file.
 * @method static string|false mimeType($path)         Get the mime-type of a given file.
 * @method static int size($path)         Get the file size of a given file.
 * @method static int lastModified($path)         Get the file's last modification time.
 * @method static bool isDirectory($directory)         Determine if the given path is a directory.
 * @method static bool isReadable($path)         Determine if the given path is readable.
 * @method static bool isWritable($path)         Determine if the given path is writable.
 * @method static bool isFile($file)         Determine if the given path is a file.
 * @method static array glob($pattern, $flags = null)         Find path names matching a given pattern.
 * @method static SplFileInfo[] files($directory, $hidden = null)         Get an array of all files in a directory.
 * @method static SplFileInfo[] allFiles($directory, $hidden = null)         Get all of the files from the given directory (recursive).
 * @method static array directories($directory)         Get all of the directories within a given directory.
 * @method static bool makeDirectory($path, $mode = null, $recursive = null, $force = null)         Create a directory.
 * @method static bool moveDirectory($from, $to, $overwrite = null)         Move a directory.
 * @method static bool copyDirectory($directory, $destination, $options = null)         Copy a directory from one location to another.
 * @method static bool deleteDirectory($directory, $preserve = null)         Recursively delete a directory.
 * @method static bool deleteDirectories($directory)         Remove all of the directories within a given directory.
 * @method static bool cleanDirectory($directory)         Empty the specified directory of all files and folders.
 */
class FS
{
    /** @var \Illuminate\Filesystem\Filesystem */
    protected static $instance;

    public static function __callStatic($name, $arguments)
    {
        if (static::$instance === null) {
            static::$instance = new Filesystem();
        }
        return static::$instance->{$name}(...$arguments);
    }

    public static function getInstance()
    {
        return static::$instance;
    }

    public static function setInstance($instance)
    {
        return static::$instance = $instance;
    }

    public static function hasInstance()
    {
        return static::$instance !== null;
    }
}
