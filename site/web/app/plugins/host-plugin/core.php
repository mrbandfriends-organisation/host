<?php

/**
 * PLUGIN CORE.
 *
 * Plugin base file. Controls initialisation of Plugin.
 */

namespace HostPluginNamespace;

class core
{
    /**
     * UNIQUE SLUG FOR PLUGIN IDENTIFICATION.
     *
     * @var string
     */
    protected static $plugin_slug = 'host_plugin_slug';

    /**
     * CONSTRUCTOR.
     *
     * Note: The job of the constructor is to create the initial
     * state of a new object. WordPress hooks have nothing to do
     * with setting up an initial internal state of an object.
     * So don't put them here.
     */
    public function __construct()
    {
    }

    /**
     * CREATES A NEW INSTANCES OF THE PLUGIN CLASS.
     */
    public static function init()
    {
        $self = new self();
        $self->start();
    }

    /**
     * COORDINATES INITIALISATION OF PLUGIN.
     */
    private function start()
    {

         // Boot all modules
        $this->init_modules();
    }

    private function init_modules()
    {
        // Comment out and replace with your requirements
        App\Universities\Container::init();
        App\Locations\Container::init();
        App\Buildings\Container::init();
        App\Rooms\Container::init();
    }

    private static function activate()
    {
        flush_rewrite_rules();
    }

    private static function deactivate()
    {
        flush_rewrite_rules();
    }

    public function load_plugin_textdomain()
    {
        $domain = $this->plugin_slug;
        $locale = apply_filters('plugin_locale', get_locale(), $domain);

        load_textdomain($domain, trailingslashit(WP_LANG_DIR).$domain.'/'.$domain.'-'.$locale.'.mo');
        load_plugin_textdomain($domain, false, basename(dirname(__FILE__)).'/languages/');
    }
}
