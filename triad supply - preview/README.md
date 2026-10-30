# Al-Atawi Trading & Contracting Group - Website

Modern responsive multi-page company website with working email backend.

## Structure
- index.html, services.html, about.html, contact.html
- css/style.css, js/main.js, js/forms.js
- php/config.php, send-contact.php, send-cv.php
- phpmailer/ (place PHPMailer src here)
- uploads/ (not public, protected by .htaccess)

## Setup Email (SMTP)
Edit `php/config.php`:
- Set SMTP_HOST, SMTP_PORT, SMTP_SECURE, SMTP_USERNAME, SMTP_PASSWORD
- Set FROM_EMAIL, FROM_NAME (use hosting's own email, e.g. info@yourdomain.com)
- RECEIVER_EMAIL = al-atwi2911@hotmail.com (do not change)
- Commented alternatives for Outlook and Gmail App Password included.

## Run locally with XAMPP
1. Install XAMPP, start Apache.
2. Copy project folder to htdocs/.
3. Download PHPMailer into phpmailer/src/.
4. Visit http://localhost/<folder>/index.html
5. Test forms at http://localhost/<folder>/contact.html

## Upload to cPanel
1. Upload all files to public_html.
2. Create email account info@yourdomain.com in cPanel.
3. Update php/config.php with cPanel SMTP settings (mail.yourdomain.com, port 587, TLS).
4. Ensure uploads/ folder writable (755/775).
5. Test both forms.

## Test forms
- Submit contact form -> email to al-atwi2911@hotmail.com with Reply-To sender.
- Submit CV form with PDF/DOC/DOCX <=5MB -> email with attachment + confirmation to applicant.

## Customize
- Text: edit HTML files.
- Colors: edit CSS variables in css/style.css.
- Numbers: edit data-target in about.html.
- Logo: replace images/logo.png (CSS circle placeholder used).
- Phone: search +966508947616 / 0508947616 across files.
