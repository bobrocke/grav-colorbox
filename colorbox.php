<?php

   namespace Grav\Plugin;

   use \Grav\Common\Plugin;

   class ColorboxPlugin extends Plugin
   {
      public static function getSubscribedEvents()
      {
         return [
            'onPluginsInitialized'  => ['onPluginsInitialized', 0],
            'onTwigSiteVariables'     => ['onTwigSiteVariables', 0]
         ];
      }

      public function onPluginsInitialized()
      {
         if ($this->isAdmin()) {
            $this->active = false;
            return;
         }
      }

      public function onTwigSiteVariables()
      {
         if (!$this->active) return;

         $page = $this->grav['page'];

         if (isset($page->header()->colorbox) && (true === $page->header()->colorbox || is_array($page->header()->colorbox))) {
            $colorbox = array_merge((array) $this->config->get('plugins.colorbox'), (array) $page->header()->colorbox);

            $this->grav['assets']
            ->addCss('plugin://colorbox/css/' . $colorbox['theme'] . '.css')
            ->addJs('plugin://colorbox/js/jquery.colorbox-min.js')
            ->addJs('plugin://colorbox/js/init.colorbox.js')
            ->addJs('plugin://colorbox/js/launch.colorbox.js');
         }
      }
   }
