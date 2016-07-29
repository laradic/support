<!---
title: Dependency Sorting 
author: Robin Radic
-->

#### Overview
| Method | Description |
|:-------|:------------|
| `add($items,$allowNumericitem=false)` | add |
| `addItem($item,$_deps=null)` | addItem |
| `sort` | sort |
| `setItem($item,$_deps)` | setItem |
| `prepNewItem($item,$_deps)` | prepNewItem |
| `satisfied($item)` | satisfied |
| `setSorted($item)` | setSorted |
| `exists($item)` | exists |
| `removeDependents($item)` | removeDependents |
| `setCircular($item,$item2)` | setCircular |
| `setMissing($item,$item2)` | setMissing |
| `setFound($item,$item2)` | setFound |
| `isSorted($item)` | isSorted |
| `requiredBy($item)` |  |
| `isDependent($item,$item2)` | isDependent |
| `hasDependents($item)` | hasDependents |
| `hasMissing($item)` | hasMissing |
| `isMissing($dep)` | isMissing |
| `hasCircular($item)` | hasCircular |
| `isCircular($dep)` | isCircular |
| `getDependents($item)` | getDependents |
| `getMissing($str=null)` | getMissing |
| `getCircular($str=null)` | getCircular |
| `getHits($str=null)` | getHits |


#### Simple
```php
use Sebwite\Dependencies\Sorter;

$sorter = new Sorter();

$sorter->add('jquery');
$sorter->add('bootstrap', ['jquery']);
$sorter->add('bootstrap-switch', ['jquery', 'bootstrap']);

$sorted = $sorter->sort();
```

#### Using classes
```php
use Sebwite\Contracts\Dependencies\Dependable;

class Asset implements Dependable {
    
    protected $name;
    
    protected $dependencies = [];
    
    public function __construct($name, array $dependencies = []){
        $this->name = $name;
        $this->dependencies = $dependencies;
    }
    
    public function getDependencies(){
        return $this->dependencies;
    }

    public function getHandle(){
        return $this->name;
    }
}
```

```php
$jquery = new Asset('jquery');
$bootstrap = new Asset('bootstrap', ['jquery']);
$bootstrapSwitch = new Asset('bootstrap-switch', ['jquery', 'bootstrap']);

$sorter = new Sorter();
$sorter->add([ $jquery, $bootstrap, $bootstrapSwitch ]);
$sorted = $sorter->sort();
```
