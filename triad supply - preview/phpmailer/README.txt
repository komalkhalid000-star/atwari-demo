Download PHPMailer from https://github.com/PHPMailer/PHPMailer and place the src/ folder here so that
phpmailer/src/PHPMailer.php, Exception.php, SMTP.php exist.

Alternatively install via Composer in project root:
  composer require phpmailer/phpmailer
Then update require paths in php/send-contact.php and php/send-cv.php to use vendor/autoload.php.
