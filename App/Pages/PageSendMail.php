<?php

/*
 * The MIT License
 *
 * Copyright 2018 Piotr Wróblewski.
 *
 */

namespace Pages;

use Core\ModelClasses\Page;
use Core\Config;

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
                
                if (filter_input(INPUT_POST, 'g-recaptcha-response', FILTER_SANITIZE_STRING) !== null) {
                    $captcha = $_POST['g-recaptcha-response'];
                    $secretKey = \Core\Config::get('RECAPTCHA_SECRET_KEY');
                    //$ip = $_SERVER['REMOTE_ADDR'];
                    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha);
                    $responseKeys = json_decode($response, true);
                    if(intval($responseKeys["success"]) !== 1) {
                        //$this->addJS('showNotification("Błędny kod CAPTCHA");');
                        echo 'Błędny kod CAPTCHA!';
                    } else {

                        if ($this->checkFilters($inputFields)) {
                            $contactFormName = filter_input(INPUT_POST, 'contact-form-name', FILTER_SANITIZE_STRING);
                            $contactFormEmail = filter_input(INPUT_POST, 'contact-form-email', FILTER_SANITIZE_STRING);
                            $contactFormMessage = filter_input(INPUT_POST, 'contact-form-message', FILTER_SANITIZE_STRING);
                            
                            $from = new \SendGrid\Email($contactFormName, $contactFormEmail);
                            $subject = "Email from wroblewskipiotr.pl";
                            $to = new \SendGrid\Email("Wróblewski Piotr", "szczypiorofix.pw@gmail.com");
                            $content = new \SendGrid\Content("text/plain", $contactFormName." pisze:<br>".$contactFormMessage);
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
                    }
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
