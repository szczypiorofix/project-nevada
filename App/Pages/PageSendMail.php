<?php

/*
 * The MIT License
 *
 * Copyright 2018 Piotr Wróblewski.
 *
 */

namespace Pages;

use Core\ModelClasses\Page, Core\Config;

/**
 * This is page for sending mail.
 *
 * @author Piotr Wróblewski <poczta@wroblewskipiotr.pl>
 */
class PageSendMail extends Page {
    

    public function defaultmethod($args) {
        
        $inputFields = [
            'contact-form-name' => FILTER_SANITIZE_STRING,
            'contact-form-email' => FILTER_SANITIZE_STRING,
            'contact-form-message' => FILTER_SANITIZE_STRING
        ];
        
        if (isset($_POST['contact-form-email'])) {
            if (filter_var($_POST['contact-form-email'], FILTER_VALIDATE_EMAIL)) {
                if ($this->checkFilters($inputFields)) {
                    $contactFormName = filter_input(INPUT_POST, 'contact-form-name', FILTER_SANITIZE_STRING);
                    $contactFormEmail = filter_input(INPUT_POST, 'contact-form-email', FILTER_SANITIZE_STRING);
                    $contactFormMessage = filter_input(INPUT_POST, 'contact-form-message', FILTER_SANITIZE_STRING);
                    
                    require(DIR_VENDORS."Sendgrid/sendgrid-php.php");

                    $from = new \SendGrid\Email("Administrator strony wroblewskipiotr.pl", "poczta@wroblewskipiotr.pl");
                    $subject = "Wiadomość ze strony www.wroblewskipiotr.pl";
                    $to = new \SendGrid\Email("Wróblewski Piotr", "szczypiorofix@o2.pl");
                    $content = new \SendGrid\Content("text/plain", $contactFormName." pisze: ".$contactFormMessage);
                    $mail = new \SendGrid\Mail($from, $subject, $to, $content);
                    
                    $sg = new \SendGrid(Config::get('SENDGRID_API_KEY'));
                    $response = $sg->client->mail()->send()->post($mail);

                    $rc = $response->statusCode();
                    if ($rc === 202) {
                        echo 'Wiadomość została wysłana. Dziękuję!';
                    } else {
                        echo 'Wystąpił błąd podczas wysyłania wiadomości. Kod odpowiedzi: '.$rc.'. Skontaktuj się z administratorem strony. Adres e-mail: poczta@wroblewskipiotr.pl.';
                    }
                } else {
                    echo 'Nie udało się wysłać wiadomości e-mail. Błąd weryfikacji pół wejściowych.';
                }
            } else {
                echo 'Wartość pola e-mail nie została poprawnie zweryfikowania. Wprowadź poprawny adres e-mail';
            }
        } else {
            echo 'Nie udało się wysłać wiadomości e-mail. Błąd weryfikacji pół wejściowych.';
        }
        exit();
    }
}
