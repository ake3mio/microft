<?php

class ContactForm
{
    private $uri = '/contact';

    public static function create()
    {
        return new ContactForm();
    }

    public function __construct()
    {
        if ($this->shouldValidateRequest()) {
            $this->handleContactFormRequest();
        }
    }

    private function handleContactFormRequest()
    {
        if ($this->isValidNonce()) {
            $recaptcha = new \ReCaptcha\ReCaptcha(getenv('MICROFT_RE_CAPTCHA_SECRET'));

            $resp = $recaptcha->setExpectedHostname($_SERVER['SERVER_NAME'])
                ->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

            if ($this->checkInput() && $resp->isSuccess()) {

                $this->sendMessage();
            }

            $home_url = get_home_url();

            if (count($_SESSION['contact_form_errors']) > 0) {
                $home_url .= '/?submit_succeeded=false';
            } else {
                $_SESSION['contact_form_submitted'] = true;
                $home_url .= '/?submit_succeeded=true';
            }

            header('Location: ' . $home_url);

            exit;
        }
    }

    private function sendMessage()
    {
        $to = getenv('MICROFT_RE_EMAIL');
        $subject = 'New message from ' . get_site_url();
        $headers = array('Content-Type: text/html; charset=UTF-8', 'From: ' . $_POST['name'] . ' <' . $_POST['email'] . '>');
        $body = nl2br(htmlentities($_POST['message']))
            . '<br/><br/><b>Phone number:</b> ' . htmlentities($_POST['phone']);


        wp_mail($to, $subject, $body, $headers);
    }

    private function shouldValidateRequest()
    {
        return $_SERVER['REQUEST_URI'] == $this->uri;
    }

    private function isValidNonce()
    {
        return isset($_REQUEST['_wpnonce']) && wp_verify_nonce($_REQUEST['_wpnonce'], 'contact_form');
    }

    private function checkInput()
    {
        $_SESSION['contact_form_errors'] = $errors = array();
        $email = $_POST['email'];
        $message = $_POST['message'];

        if ((trim($_POST['name']) == '') || empty($_POST['name'])) {
            $errors[] = 'name.required';
        }

        if ((trim($message) == '') || empty($message)) {
            $errors[] = 'message.required';
        }

        if (trim($email) == '' || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'email.invalid';
        }

        $_SESSION['contact_form_errors'] = $errors;

        return count($errors) == 0;
    }
}
