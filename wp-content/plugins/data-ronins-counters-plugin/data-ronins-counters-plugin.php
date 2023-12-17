<?php
/*
Plugin Name: Data Ronins Login&Register Counters
Description: A plugin to count login and register events.
Version: 1.0
Author: Nikolay Vasilev
*/

/**
 * Custom script to be enqueued
 */
function CustomLoginFormScript() {
    $scriptHandle = 'custom-login-form-script';
    wp_enqueue_script( $scriptHandle, plugins_url('data-ronins-counters-plugin.js', __FILE__), array('jquery'), '1.0', true);
    wp_localize_script( $scriptHandle, 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}

// Adding the custom script to the login scripts queue with default priority and 0 parameters
add_action('login_enqueue_scripts', 'CustomLoginFormScript', 10, 0);

/**
 * Logic to increment counters. 
 * Expects a POST parameter named 'counter_type' of type integer. Possible values: 
 * 1 - login 
 * 2 - register
 */
function IncrementCounter() {
    $counterType = (int)$_POST['counter_type'];

    switch ($counterType){
        case 2:
            $optName = 'register_counter';
            break;
        case 1:
            $optName = 'login_counter';
            break;
        default:
            $optName = 'malicious_counter';
            break;
    }
    
    $counter = get_option( $optName, 0);
    $counter++;
    update_option($optName, $counter);

    return;
}

// Adding the AJAX call handler. The handler is added to the 'nopriv' context 
// as it should not be used in the context of an authenticated user.
add_action('wp_ajax_nopriv_increment_counter', 'IncrementCounter');

/**
 * Logic to add the visual representations of the counters
 */
function CustomCountersDisplay() {
    $loginCount = get_option('login_counter', 0);
    $registerCount = get_option('register_counter', 0);
    $maliciousCount = get_option('malicious_counter', 0);

    echo '<div><b>Login Attempts: ' . $loginCount . '</div>';
    echo '<div>Register Attempts: ' . $registerCount . '</div>';
    if ( $maliciousCount > 0 ) {
        echo '<div style="color: red;">Malicious Attempts: ' . $maliciousCount . '</div>';
    }
    echo '</b><br/><br/>';
}

// Adding the logic for the new counters to just-before-the-end of the login form rendering
add_action('login_form', 'CustomCountersDisplay');

