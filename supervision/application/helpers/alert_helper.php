<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('display_alert')) {
    function display_alert() {
        $CI =& get_instance();
        if ($CI->session->flashdata('msg')) {
            // Optionally log the message instead of displaying it
            log_message('info', $CI->session->flashdata('msg'));

            // Uncomment the following line to render the alert if needed
            // echo '<div class="alert alert-warning">' . $CI->session->flashdata('msg') . '</div>';
        }
    }
}
