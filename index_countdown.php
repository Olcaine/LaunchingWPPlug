<?php
/*
Plugin Name: countDown
Description: Un plugin d'introduction pour le développement sous WordPress
Version: 0.1
Author: Olcaine
Author URI: http://lauching/
*/


class Newsletter_Plugin

{

    public function __construct()
    {
        include_once plugin_dir_path(__FILE__).'/countdown.php';

        new Newsletter();
        register_activation_hook(__FILE__, array('Newsletter', 'install'));
        register_uninstall_hook(__FILE__, array('Newsletter', 'uninstall'));

        add_action('admin_menu', array($this, 'add_admin_menu'));
    }

        public function add_admin_menu()
        {
            add_menu_page('Newsletter Plugin', 'Launching', 'manage_options', 'Newsletter', array($this, 'menu_html'));
        }

        public function menu_html()
        {
            global $wpdb;
            echo '<h1>'.get_admin_page_title().'</h1>';
            echo '<p>Bienvenue sur la page d\'accueil du plugin</p>';
            $results = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}newsletter_email");
            if (!empty($results)) {
                echo "<ul>Subscriber list :";
                foreach ($results as $row) {

                    echo "<li>".$row->email."</li>";
                }
                echo "</ul>";
            }
        }

    }

    new Newsletter_Plugin();
