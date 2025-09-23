<?php
// Start session only if not active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Site timezone
$conf['site_timezone'] = 'Africa/Nairobi';

// Site information
$conf['site_name'] = 'Alex Academy';
$conf['site_url'] = 'http://localhost/ICS_2B';
$conf['admin_email'] = 'your_email@gmail.com'; // must match smtp_user

// Site language
$conf['site_lang'] = 'en';
require_once __DIR__ . '/Lang/' . $conf['site_lang'] . '.php';

// Database configuration
$conf['db_type'] = 'pdo';
$conf['db_host'] = 'localhost';
$conf['db_user'] = 'root';
$conf['db_pass'] = '';
$conf['db_name'] = 'my_academy_db';

// Email configuration (Gmail with App Password)
$conf['mail_type']   = 'smtp'; 
$conf['smtp_host']   = 'smtp.gmail.com';
$conf['smtp_user']   = 'muriithia05@gmail.com';       // full Gmail address
$conf['smtp_pass']   = 'bqfq irzv vcrt tzdf';     // 16-char Gmail App Password
$conf['smtp_port']   = 465;                          // 465 for SSL, 587 for TLS
$conf['smtp_secure'] = 'ssl';                        // 'ssl' or 'tls'

// Password rules
$conf['min_password_length'] = 8;

// Allowed email domains
$conf['valid_email_domain'] = [
    'alexacademy.com',
    'yahoo.com',
    'gmail.com',
    'outlook.com',
    'hotmail.com',
    'strathmore.edu'
];

// Verification code
$conf['reg_ver_code'] = rand(100000, 999999);
$conf['ver_code_expiry'] = 10; // minutes
