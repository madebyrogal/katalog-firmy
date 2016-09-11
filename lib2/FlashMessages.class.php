<?php
class FlashMessages
{
    static public function get($name)
    {
      $flashes = array(
          'registration_success_and_mail_sent' => 'Zarejestrowałeś się w serwisie. Na podany adres email została wysłana wiadomość z linkiem weryfikacyjnym. Po jego kliknięciu uzyskasz pełny dostęp do konta.',
          'registration_success_and_waits_for_admin_activation' => 'Zarejestrowałeś się w serwisie. Poczekaj na aktywację konta przez administratora serwisu.',
          'registration_success_and_signed_in' => 'Konto utworzone - zostałeś zalogowany.',
          'activation_success_and_signed_in' => 'Konto zostało aktywowane - zostałeś zalogowany.',
          'activation_success_and_mail_sent_to_user' => 'Konto zostało aktywowane. Powiadomienie zostało wysłane do użytkownika.',
          'form_message_error' => 'Przepraszamy, wystąpił błąd. Zmiany nie zostały zapisane.',
          'form_message_invalid' => 'Popraw dane w formularzu.',
          'signin_error' => 'Podałeś błędne dane logowania.',
          'order_not_valid' => 'Wpisz poprawne dane.',
          'signin_success' => 'Zalogowałeś się w serwisie.',
      );

      return isset($flashes[$name]) ? $flashes[$name] : null;
    }
}

?>
