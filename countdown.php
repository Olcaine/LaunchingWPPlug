<?php
    class Newsletter
    {

        public function __construct()
        {
            add_action('wp_loaded', array($this, 'save_email'));
        }

        public static function install()
        {
            global $wpdb;

            $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}newsletter_email (id INT AUTO_INCREMENT PRIMARY KEY, email VARCHAR(255) NOT NULL);");

        }

        public static function uninstall()
        {
            global $wpdb;

            $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}newsletter_email;");

        }

        public function save_email()
        {
            if (isset($_POST['email']) && !empty($_POST['email'])) {
                global $wpdb;
                $email = $_POST['email'];

                $row = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}newsletter_email WHERE email = '$email'");
                if (is_null($row)) {
                    $wpdb->insert("{$wpdb->prefix}newsletter_email", array('email' => $email));
                }
            }
        }

    }
    new Newsletter();
