<!---
title: Path
subtitle: Utilities
author: Robin Radic
-->

The `Path` class contains utility methods for handling path strings. 
The methods in this class are able to deal with both UNIX and Windows paths with both forward and backward slashes. 

#### Overview
| Method | Description |
|:-------|:------------|
| `join(...$parts)` | Joins a split file system path. |
| `getDirectoryName($path)` |  |
| `canonicalize($path)` | Canonicalizes the given path. |
| `getDirectory($path)` | Returns the directory part of the path. |
| `getRoot($path)` | Returns the root directory of a path. |
| `getFilename($path)` | Returns the filename from a file path. |
| `getFilenameWithoutExtension($path,$extension=null)` | Returns the filename without the extension from a file path. |
| `getExtension($path,$forceLowerCase=false)` | Returns the extension from a file path. |
| `hasExtension($path,$extensions=null,$ignoreCase=false)` | Returns whether the path has an extension. |
| `changeExtension($path,$extension)` | Changes the extension of a path string. |
| `isAbsolute($path)` | Returns whether a path is absolute. |
| `isRelative($path)` | Returns whether a path is relative. |
| `makeAbsolute($path,$basePath)` | Turns a relative path into an absolute path. |
| `makeRelative($path,$basePath)` | Turns a path into a relative path. |
| `isLocal($path)` | Returns whether the given path is on the local filesystem. |
| `getLongestCommonBasePath($paths)` | Returns the longest common base path of a set of paths. |
| `isBasePath($basePath,$ofPath)` | Returns whether a path is a base path of another path. |
| `split($path)` | Splits a part into its root directory and the remainder. |
| `toLower($str)` | Converts string to lower-case (multi-byte safe if mbstring is installed). |


#### Usage
```php
use Laradic\Support\Path;

echo Path::join('/var/www/vhost', '..', 'myhost', 'config.ini');
// => /var/www/myhost/config.ini

echo Path::getDirectoryName('/var/www/vhost/laradic/config.ini');
// => vhost

echo Path::canonicalize('/var/www/vhost/laradic/../config.ini');
// => /var/www/vhost/config.ini

echo Path::canonicalize('C:\Programs\laradic\..\config.ini');
// => C:/Programs/config.ini

echo Path::makeAbsolute('config/config.yml', '/var/www/project');
// => /var/www/project/config/config.yml

echo Path::makeRelative('/var/www/project/config/config.yml', '/var/www/project/uploads');
// => ../config/config.yml

$paths = array(
    '/var/www/vhosts/project/httpdocs/config/config.yml',
    '/var/www/vhosts/project/httpdocs/images/banana.gif',
    '/var/www/vhosts/project/httpdocs/uploads/../images/nicer-banana.gif',
);

Path::getLongestCommonBasePath($paths);
// => /var/www/vhosts/project/httpdocs

Path::getFilename('/views/index.html.twig');
// => index.html.twig

Path::getFilenameWithoutExtension('/views/index.html.twig');
// => index.html

Path::getFilenameWithoutExtension('/views/index.html.twig', 'html.twig');
Path::getFilenameWithoutExtension('/views/index.html.twig', '.html.twig');
// => index

Path::getExtension('/views/index.html.twig');
// => twig

Path::hasExtension('/views/index.html.twig');
// => true

Path::hasExtension('/views/index.html.twig', 'twig');
// => true

Path::hasExtension('/images/profile.jpg', array('jpg', 'png', 'gif'));
// => true

Path::changeExtension('/images/profile.jpeg', 'jpg');
// => /images/profile.jpg
```
