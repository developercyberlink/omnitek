<?php
// Enable strict transport security
header("Strict-Transport-Security: max-age=31536000; includeSubDomains");

// Set content security policy
header("Content-Security-Policy: defaul-src 'self','none','unsafe-eval'");

// Prevent clickjacking with X-Frame-Options
header("X-Frame-Options: SAMEORIGIN");

// Enable XSS protection
header("X-XSS-Protection: 1; mode=block");

// Prevent MIME-sniffing with X-Content-Type-Options
header("X-Content-Type-Options: nosniff");

// Set Referrer-Policy
header("Referrer-Policy: 'no-referrer', 'no-referrer-when-downgrade', 'same-origin'");

// Set Permissions-Policy for browser features
header("Permissions-Policy: geolocation=(self 'https://omniteksys.com/'), microphone=()");
?>