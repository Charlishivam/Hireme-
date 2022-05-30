<?php

#---------------------------------------------------------------------------------
# ADDITIONAL FILE TO WRITE ALL THE CONSTANTS AND CONFIGURATIONS FOR UAT OR TESTING
#---------------------------------------------------------------------------------

define('APP_NAME', 'TemplateZone');
define('FROM_NAME', 'TemplateZone');
define('FROM_EMAIL', 'noreply@templateZone.com');
define('CACHE_SESSION_TIME', 86400); // 24 hours
define('LINK_EXPIRATION_TIME', 1800); // 30 mins

#---------------------------------------------------------------------------------
# EMAIL, SENDMAIL, SMTP || AVAILABLE PROTOCOLS: mail, sendmail, smtp
#---------------------------------------------------------------------------------

// define('EMAIL_PROTOCOL', 'smtp.gmail.com'); 			// mail
// define('USER_AGENT', 'HunarHaaT');
// define('SMTP_HOST', 'smtp.mailtrap.io');
// define('SMTP_USER', '0xveera@gmail.com');
// define('SMTP_PASSWORD', 'Baba#7777');
// define('SMTP_PORT', 465);
// define('SMTP_TIMEOUT', 60);
// define('SMTP_KEEPALIVE', false);
// define('SMTP_CRYPTO', 'ssl');
// define('MAIL_TYPE', 'html'); // text or html
// define('OTP_VERIFY_TIME', 300);

define('EMAIL_PROTOCOL', 'smtp'); 			// mail
define('USER_AGENT', 'HunarHaaT');
define('SMTP_HOST', 'smtp.mailtrap.io');
define('SMTP_USER', '59bda672678d37');
define('SMTP_PASSWORD', 'a941e80c4afab3');
define('SMTP_PORT', 2525);
define('SMTP_TIMEOUT', 5);
define('SMTP_KEEPALIVE', false);
define('SMTP_CRYPTO', 'tls');
define('MAIL_TYPE', 'html'); // text or html
define('OTP_VERIFY_TIME', 300);

// define('EMAIL_PROTOCOL', 'smtp');
// define('USER_AGENT', 'HunarHaaT');
// define('SMTP_HOST', 'smtp.mailtrap.io');
// define('SMTP_USER', '1b875ef9da7f90');
// define('SMTP_PASSWORD', 'ec9780d3e08b51');
// define('SMTP_PORT', 2525);
// define('SMTP_TIMEOUT', 5);
// define('SMTP_KEEPALIVE', false);
// define('SMTP_CRYPTO', 'tls');
// define('MAIL_TYPE', 'html'); // text or html
// define('OTP_VERIFY_TIME', 300);

#--------------------------------------------------------------------
# RSA CERTIFICATE & AES KEY
#--------------------------------------------------------------------

define('RSA_PRIVATE_KEY','LS0tLS1CRUdJTiBSU0EgUFJJVkFURSBLRVktLS0tLQpNSUlDWGdJQkFBS0JnUUN6ajBMT0FIcXRldXozUVczaUM5NnU0b2RFVFFlMnp6VFJ2ZUoyby9DWjNvRmcwU0ZiCmc2bGIxT0RRRzlVcXQwVE4rVjB4VENvMWJEQ3dkVzNkSnQzZHdrRklXUG5YOEEwbmI1SjEyZjRIZjdudFBJQkYKRkZsbHRNaVVZSlpSZ3owRHZvdGhnak9qMmNta1ltRnd2N2VhUEhOSWdTMXVxSlpkbE8zeTlaV2RPd0lEQVFBQgpBb0dBZThUR01hVVc2cm1PMmFnYUMvUk9uSkc4MTVHWlBhTjZMeEVLSnVrK0VYSFVFRjVXOWZPOUszV0RPUy9XCk1jbDkvZFJqTG5YbnFrZFhFR3NCUGExcXhDY1dmandSV0M4MGd4NVR3dDhqUzVwSGNtM1dVTi91UU1NYWhWdjEKOFltT0k1VkNSVXI1SWxVOFNXQ280N1pNdUQ4S0tQZjN0cjhDaFBiTFlwNjRVb0VDUVFEZzlLbkZJU29UTDhqUwpWUTUrWGw0T3BQOEZwV2xaZ2NjQm9GUW9UN1ZkWGVTNTZ4cEs2M0hneVIwbHRNbDA1STNoTUo0OU5mL25pb3lIClVmYlFaSW9iQWtFQXpGYlM1emlxTzVjSGZFREpLaklEVlc2ck0xOEUvdEVpQ3BSL3N0VjBZVU5vcTJVTE4rRmEKMXo3OGVGVzRUeVBqNkM4Nk1kUU9LWHM2d2V0UWlZeHJZUUpCQU13VGFRaGF3ODdRSk1FYlJLRERmMVNOdm9VaQp3R1hnNCtiSHlsRWZyb3JiS1NxNDdBdFhlT0hSMFUxcHF2RU9mdC94dVR3U2h1dEl0NS96YlpNMEFrMENRUUNwCmh3OEt6alJOcEF1TnhxSWU0OGRvUlp5N3pnVnk4MGJ1eUN6NXphWDBXOXltOWZuTXJxYVRGYXFZbTJXQ0l5Q2UKTFRCMnpwdkJSbitGQ3htU1JIR0JBa0VBc2VLTjRmaDhWMWVENjhnNkgxdzRzNU9mcE1lVzVpVnVGR1MwZkhUQQpkUGlMd2FNYk9adnhDMnRjdWwzVkoySmcvVEVIYk1WTWl2cmxSMURjT0R2Q3FRPT0KLS0tLS1FTkQgUlNBIFBSSVZBVEUgS0VZLS0tLS0=');

define('AES_KEY', 'XYUMLofZ9F6fjpYl9w0Ceb7Bp/LgMaqs+/xf3U2QS8Q=');

#--------------------------------------------------------------------
# PAGINATION
#--------------------------------------------------------------------

define('PAGE_LIMIT', 10);
define('PAGE_LIMIT_TEMP', 13);

#--------------------------------------------------------------------
# Company Info
#--------------------------------------------------------------------

define('OFFICE_CONTACT_NO', '+91-9012345543');
define('OFFICE_EMAIL', 'info@greeting.com');
define('COPY_RIGHT', ' Copyright Greeting private limited. All rights reserved.');