<!---
title: Filesystem
subtitle: Extra filesystem methods 
author: Robin Radic
-->

# Filesystem
- The `Filesystem` class extends the default Laravel `Illuminate\Filesystem\Filesystem` class.
- By registering the `BeverageServiceProvider`, it will automatically bind itself to `fs`. 
- The `BeverageServiceProvider` will also include the `helpers.php` file, that have a all methods provided by the `Filesystem` class prefixed by `file_` (eg: `file_delete`). 

##### Overview
| Method | Description |
|:-------|:------------|
| `exists($path)` | Determine if a file exists. |
| `get($path)` | Get the contents of a file. |
| `getRequire($path)` | Get the returned value of a file. |
| `requireOnce($file)` | Require the given file once. |
| `put($path,$contents,$lock=false)` | Write the contents of a file. |
| `prepend($path,$data)` | Prepend to a file. |
| `append($path,$data)` | Append to a file. |
| `delete($paths)` | Delete the file at a given path. |
| `move($path,$target)` | Move a file to a new location. |
| `copy($path,$target)` | Copy a file to a new location. |
| `name($path)` | Extract the file name from a file path. |
| `extension($path)` | Extract the file extension from a file path. |
| `type($path)` | Get the file type of a given file. |
| `mimeType($path)` | Get the mime-type of a given file. |
| `size($path)` | Get the file size of a given file. |
| `lastModified($path)` | Get the file's last modification time. |
| `isDirectory($directory)` | Determine if the given path is a directory. |
| `isWritable($path)` | Determine if the given path is writable. |
| `isFile($file)` | Determine if the given path is a file. |
| `glob($pattern,$flags=0)` | Find path names matching a given pattern. |
| `files($directory)` | Get an array of all files in a directory. |
| `allFiles($directory)` | Get all of the files from the given directory (recursive). |
| `directories($directory)` | Get all of the directories within a given directory. |
| `makeDirectory($path,$mode=493,$recursive=false,$force=false)` | Create a directory. |
| `copyDirectory($directory,$destination,$options=null)` | Copy a directory from one location to another. |
| `deleteDirectory($directory,$preserve=false)` | Recursively delete a directory. |
| `cleanDirectory($directory)` | Empty the specified directory of all files and folders. |
| `mkdir($dirs,$mode=511)` | Creates a directory recursively. |
| `touch($files,$time=null,$atime=null)` | Sets access and modification time of file. |
| `chmod($files,$mode,$umask=0,$recursive=false)` | Change mode for an array of files or directories. |
| `chown($files,$user,$recursive=false)` | Change the owner of an array of files or directories. |
| `chgrp($files,$group,$recursive=false)` | Change the group of an array of files or directories. |
| `rename($origin,$target,$overwrite=false)` | Renames a file or a directory. |
| `symlink($originDir,$targetDir,$copyOnWindows=false)` | Creates a symbolic link or copy a directory. |
| `makePathRelative($endPath,$startPath)` | Given an existing path, convert it to a path relative to a given starting path. |
| `mirror($originDir,$targetDir,$iterator=null,$options=array())` | Mirrors a directory to another. |
| `rglob($pattern,$flags=0)` | Recursively find pathnames matching the given pattern. |
| `rsearch($folder,$pattern)` | Search the given folder recursively for files using a regular expression pattern. |

