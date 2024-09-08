<?php

if (!function_exists('sendMail')) {
    function sendMail($emails, $subject, $message) {
        if (config('mail.protocol') == 'smtp') {
            ini_set('SMTP', config('mail.smtp_domain'));
            ini_set('smtp_port', config('mail.smtp_port'));
        }
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: '.config('mail.form_address') . "\r\n";
        return mail($emails[0], $subject, $message, $headers);
    }
}
