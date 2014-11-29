<?php
namespace Grav\Plugin;

use \Grav\Common\Plugin;
use \Grav\Common\Grav;
use \Grav\Common\Page\Page;

class ColorboxPlugin extends Plugin
{
    /**
     * @return array
     */
    public static function getSubscribedEvents() {
        return [
            'onPageInitialized' => ['onPageInitialized', 0],
            'onTwigSiteVariables' => ['onTwigSiteVariables', 0]
        ];
    }

    /**
     * Initialize configuration
     */
    public function onPageInitialized()
    {
        $defaults = (array) $this->config->get('plugins.colorbox');

        /** @var Page $page */
        $page = $this->grav['page'];
        if (isset($page->header()->colorbox)) {
            $this->config->set('plugins.colorbox', array_merge($defaults, $page->header()->colorbox));
        }
    }

    /**
     * if enabled on this page, load the JS + CSS theme.
     */
    public function onTwigSiteVariables()
    {
        if ($this->config->get('plugins.colorbox.enabled')) {
            $theme = $this->config->get('plugins.colorbox.theme') ?: 'default';
            $this->grav['assets']->addCss('plugin://colorbox/css/'.$theme.'.css');
            $this->grav['assets']->addJs('plugin://colorbox/js/jquery.colorbox-min.js');
            $this->grav['assets']->addJs('plugin://colorbox/js/init.colorbox.js');
            $this->grav['assets']->addJs('plugin://colorbox/js/launch.colorbox.js');
        }
    }
}
