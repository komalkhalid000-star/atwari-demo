<?php
/**
 * Configuration for Al-Atawi Trading & Contracting Group
 * Edit SMTP settings to match your hosting provider.
 */

// SMTP Settings - Update these for your hosting environment
define('SMTP_HOST', 'smtp.yourhosting.com');        // e.g. mail.yourdomain.com
define('SMTP_PORT', 587);
define('SMTP_SECURE', 'tls');                        // tls or ssl
define('SMTP_USERNAME', 'info@yourdomain.com');     // your hosting email account
define('SMTP_PASSWORD', 'your-email-password');      // your email password or app password
define('SMTP_AUTH', true);

// From / Receiver
define('FROM_EMAIL', 'info@yourdomain.com');
define('FROM_NAME', 'Al-Atawi Trading & Contracting Group');
define('RECEIVER_EMAIL', 'al-atwi2911@hotmail.com');

// Site URL (used in emails)
define('SITE_URL', 'https://yourdomain.com');