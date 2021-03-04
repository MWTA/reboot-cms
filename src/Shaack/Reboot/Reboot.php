<?php
/**
 * Author and copyright: Stefan Haack (https://shaack.com)
 * Repository: https://github.com/shaack/reboot-cms
 * License: MIT, see file 'LICENSE'
 */

namespace Shaack\Reboot;

use Shaack\Utils\Logger;
use Symfony\Component\Yaml\Yaml;

class Reboot
{
    public $baseDir; // The CMS root
    public $baseUrl; // the base URL, requests /web
    public $requestUri; // the request Uri
    public $route; // the route in /web or content/pages
    public $globals; // global values / configuration for the website
    public $config; // local configuration
    public $theme; // the theme

    /**
     * Reboot constructor.
     * @param string $uri
     */
    public function __construct(string $uri, string $baseDir)
    {
        $this->requestUri = strtok($uri, '?');
        $this->baseDir = $baseDir;
        $this->baseUrl = rtrim(str_replace("index.php", "", $_SERVER['PHP_SELF']), "/");
        $this->route = rtrim($this->requestUri, "/");
        $this->config = Yaml::parseFile($this->baseDir . '/local/config.yml');
        $this->theme = new Theme($this, $this->config['theme']);
        if (strpos($this->route, "/theme/assets/") === 0) {
            $this->theme->renderAsset($this->route);
        }
        if (strpos($this->route, "/vendor/") === 0) {
            $pathInfo = pathinfo($this->route);
            if($pathInfo['extension'] === "css") {
                header('Content-type: text/css');
            } else if($pathInfo['extension'] === "js") {
                header('Content-type: application/javascript');
            }
            /** @noinspection PhpIncludeInspection */
            include($this->baseDir . $this->route);
            exit();
        }
        Logger::setActive($this->config['logging']);
        Logger::log("---");
        Logger::log("request: " . $this->requestUri);
        $this->globals = Yaml::parseFile($this->baseDir . '/content/globals.yml');
        if (!$this->route || is_dir($this->baseDir . '/content/pages' . $this->route)) {
            $this->route = $this->route . "/index";
        }
        Logger::log("route: " . $this->route);
    }

    /**
     * @return string
     */
    public function render()
    {
        $page = new Page($this);
        $template = new Template($this, $page);
        return $template->render();
    }

    public function redirect($url)
    {
        Logger::log("=> redirect: " . $url);
        header("Location: " . $url);
        exit;
    }
}