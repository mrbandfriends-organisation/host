<?php
/**
 * TEMPLATEABLE
 *
 * trait providing the ability to include a template via output buffering
 */

namespace HostPluginNamespace\Traits;

trait Templatable {
    public function locate_template( $template_name, $data=array() ) {

        $templates_directory = 'templates/';

        // Append '.php' if the dev forgot!
        if ( !strpos($template_name, '.php') ) {
            $template_name = $template_name . '.php';
        }

        $template = $templates_directory . $template_name;


        // Check Theme then fallback to a matching directory in the Plugin
        if ( locate_template( $template ) ) {
            $template = get_stylesheet_directory() . '/' . $template;
        } else {
            $template = plugin_dir_path( dirname( __FILE__ ) ) . $template;
        }


        // Optionally provided an assoc array of data to pass to tempalte
        // and it will be extracted into variables
        if ( is_array( $data ) ) {
            extract($data);
        }

        ob_start();
        include( $template );
        $var = ob_get_contents();
        ob_end_clean();

        return $var;
    }
}
