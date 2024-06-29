<?php

namespace Jenssegers\Blade;

use Closure;
use Illuminate\Container\Container as BaseContainer;

class Container extends BaseContainer
{
    protected array $terminatingCallbacks = [];
    protected $appNameSpace = '';
    
    public function setAppNamespace($namespace)
    {
        $this->appNameSpace = $namespace;
    }

    public function getNamespace()
    {    
        return $this->appNameSpace;
    }

    public function terminating(Closure $callback)
    {
        $this->terminatingCallbacks[] = $callback;

        return $this;
    }

    public function terminate()
    {
        foreach ($this->terminatingCallbacks as $terminatingCallback) {
            $terminatingCallback();
        }
    }
}
