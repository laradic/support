<?php
namespace Laradic\Tests\Support\Fixture;

use Laradic\Support\ServiceProvider;

class TestServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->resolveDirectories();
        $assetsPath = $this->resolvePath('assetsPath', ['dirName' => 'assets']);
        $assetsDestinationPath = $this->resolvePath('assetsDestinationPath', ['namespace' => 'sebwite']);


        $a = 'a';
    }

}