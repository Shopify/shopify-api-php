<?php

// @codingStandardsIgnoreFile

use Composer\Autoload\ClassLoader;
use Shopify\Context;
use Shopify\Exception\ShopifyException;

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
                    $folderName = "Admin" . ucfirst(str_replace("-", "_", Context::$API_VERSION));
                    if (!file_exists(__DIR__ . "/Rest/$folderName")) {
                        throw new ShopifyException(
                            "This version of the Shopify library does not provide REST resources for API version " .
                                "'" . Context::$API_VERSION . "'"
                        );
                    }

                    // If we failed to autoload the class, let's see if it's not a resource
                    $name = implode("\\", [$parts[0], $parts[1], $folderName, $parts[2]]);
                }
            }
        }

        return $this->loader->loadClass($name);
    }
}

$loader = require __DIR__ .  '/../vendor/autoload.php';
$loader->unregister();
spl_autoload_register(array(new RestResourceAutoloader($loader), 'loadClass'));
