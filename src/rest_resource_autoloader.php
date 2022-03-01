<?php

// @codingStandardsIgnoreFile

use Composer\Autoload\ClassLoader;
use Shopify\Context;

class RestResourceAutoloader
{
    /** @var ClassLoader */
    private $loader;

    public function __construct($loader)
    {
        $this->loader = $loader;
    }

    public function loadClass($name)
    {
        if (class_exists("Shopify\\Context")) {
            $parts = explode("\\", $name);
            // This assumes all resources are namespaced like: Shopify\Rest\Admin<version>\<resource>
            if (
                count($parts) === 3 &&
                [$parts[0], $parts[1]] === ["Shopify", "Rest"]
            ) {
                if ($defaultClass = $this->loader->loadClass($name)) {
                    return $defaultClass;
                } else {
                    // If we failed to autoload the class, let's see if it's not a resource
                    $name = implode("\\", [
                        $parts[0],
                        $parts[1],
                        "Admin" . ucfirst(str_replace("-", "_", Context::$API_VERSION)),
                        $parts[2],
                    ]);
                }
            }
        }

        return $this->loader->loadClass($name);
    }
}

$loader = require 'vendor/autoload.php';
$loader->unregister();
spl_autoload_register(array(new RestResourceAutoloader($loader), 'loadClass'));
