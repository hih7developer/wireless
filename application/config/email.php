<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
    'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
    'smtp_host' => 'smtp.googlemail.com', 
    'smtp_port' => 465,
    'smtp_user' => 'webdeveloper@hih7.com',
    'smtp_pass' => 'xsihvuuluqaefbrc',
    'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
    'mailtype' => 'html', //plaintext 'text' mails or 'html'
    // 'smtp_timeout' => '4', //in seconds
    'charset' => 'iso-8859-1',
    'wordwrap' => TRUE
);