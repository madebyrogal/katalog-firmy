<?php

class importUsersStgTask implements stgTaskInterface
{
  private $testDB = array('host' => 'localhost',
                              'db' => 'cafesilesia_shopper_kopia2',
                              'user' => 'root',
                              'pass' => '',
                              'users_table' => 'custommers',
                              'user_address_table' => 'user_address_book',
                              'users_info_table' => 'cust_info');

  private $prodDB = array('host' => 'sql.wmm.nazwa.pl',
                              'db' => 'wmm_10',
                              'user' => 'wmm_10',
                              'pass' => 'nhy7-6TGB',
                              'users_table' => 'custommers',
                              'user_address_table' => 'user_address_book',
                              'users_info_table' => 'cust_info');

  private $externalDB = array();
  protected $pdo;
  protected $limit;

  public function execute($options) {

    //opcje
    //[0]
    $this->limit = isset($options[0]) ? (int) $options[0] : 50;
    //[1]
    $this->externalDB = (isset($options[1]) && $options[1] == 'prod') ? $this->prodDB : $this->testDB ; // OSTROŻNIE! jesli chcemy dane z zywej bazy shopera to podajemy opcje 'prod'

    try
    {
      $this->pdo = new PDO('mysql:host='.$this->externalDB['host'].';dbname='.$this->externalDB['db'], $this->externalDB['user'], $this->externalDB['pass']);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->pdo->query('SET NAMES utf8');

      $usernames_array = $this->importUsers($options);
      $this->importAddresses($usernames_array);

    }
    catch(PDOException $e)
    {
      echo 'Import nie udał się.';
//var_dump ($e);
    }

  }

  public function importUsers() {
      $usernames_array = array();

      $ext_users = $this->pdo->query('SELECT * FROM '.$this->externalDB['users_table'].' u'
                              .' LEFT JOIN '.$this->externalDB['users_info_table'].' ui ON (u.user_id = ui.user_id)'
                              .' LEFT JOIN '.$this->externalDB['user_address_table'].' ua ON (u.user_id = ua.user_id)'
                              .' WHERE u.verify_email = true' //tylko aktywni
                              .' AND u.login NOT IN ('.implode(",", Doctrine::getTable('sfGuardUser')->getFieldValuesArray('username', '"', '"')).')' //nie importujemy kont z username już obecnym w systemie
                              .' AND ui.email NOT IN ('.implode(",", Doctrine::getTable('sfGuardUser')->getFieldValuesArray('email_address', '"', '"')).')' //nie importujemy kont z emailem już obecnym w systemie
                              .' AND (ua.ab_default IS NULL OR ua.ab_default = true)'
                              .' AND u.user_id = ( SELECT MAX(ui2.user_id) FROM '.$this->externalDB['users_info_table'].' ui2 WHERE ui2.email = ui.email )' //email musi byc unikatowy - w przypadku duplikatow bierzemy nowszy rekord
.' LIMIT '.((int) $this->limit)
                              );


      $users_count = $ext_users->rowCount();
      echo 'Ilość użytkowników do importu: '.$users_count."\n";

      $i = 0;
      foreach($ext_users as $ext_user)
      {
        $i++;
        $username = $ext_user['login'];
        $password = $ext_user['pass'];
        $email = $ext_user['email'];
        $firstname = $ext_user['firstname'];
        $lastname = $ext_user['lastname'];
        $discount = $ext_user['discount'];

        $company = $ext_user['ab_company_name'];
        $address_firstname = $ext_user['ab_firstname'];
        $address_lastname = $ext_user['ab_lastname'];

        $address_name = implode(' ', array($address_firstname, $address_lastname));
        if ($company && $company != '') {
          $address_name = $company.', '.$address_name;
        }

        $nip = $ext_user['ab_tax_id'];
        $street = $ext_user['ab_street_1'];
        $city = $ext_user['city'];
        $post_code = $ext_user['zip_code'];
        $region = $ext_user['state'];
        $country = $ext_user['country'];
        $phone = $ext_user['phone'];

        if ($i%10 == 0) {
          echo 'Dodawanie użytkownika '.$i.' z '.$users_count.' : '.$username.' ('.$email.')'."\n";
        }

        $user = new sfGuardUser();
        $user->setEmailAddress($email);
        $user->setUsername($username);
        $user->setPasswordHash($password);
        $user->setFirstName($firstname);
        $user->setLastName($lastname);
        $user->save();
        $user->addGroupByName('Klienci');

        $user->Profile->DefaultInvoiceAddress->setName($address_name);
        $user->Profile->DefaultInvoiceAddress->setNip($nip);
        $user->Profile->DefaultInvoiceAddress->setStreet($street);
        $user->Profile->DefaultInvoiceAddress->setCity($city);
        $user->Profile->DefaultInvoiceAddress->setPostCode($post_code);
        $user->Profile->DefaultInvoiceAddress->setRegion($region);
        $user->Profile->DefaultInvoiceAddress->setCountry($country);
        $user->Profile->DefaultInvoiceAddress->setPhone($phone);
        $user->Profile->DefaultInvoiceAddress->save();

        $user->Profile->setName($address_name);
        $user->Profile->setDiscountWebOnly($discount);
        $user->Profile->save();

        $usernames_array[] = '"'.$user->getUsername().'"';
      }

      $ext_users->closeCursor();
      return $usernames_array;
  }

  public function importAddresses($usernames_array) {

      $ext_addresses = $this->pdo->query('SELECT * FROM '.$this->externalDB['user_address_table'].' ua'
                              .' LEFT JOIN '.$this->externalDB['users_table'].' u ON (ua.user_id = u.user_id)'
                              .' WHERE u.login IN ('.implode(",", $usernames_array).')' //adresy dla wlasnie zaimportowanych userów
                              .' AND ua.ab_default = false'
                              );

      $addresses_count = $ext_addresses->rowCount();
      echo 'Ilość dodatkowych adresów w bazie zewnętrznej: '.$addresses_count."\n";

      $usernames = array();
      $ext_addresses_array = array();
      foreach($ext_addresses as $ext_address)
      {
        $username = $ext_address['login'];
        $usernames[] = $username;
        $ext_addresses_array[] = $ext_address;
      }
      if (count($usernames)) {
        $users = Doctrine::getTable('sfGuardUser')->getUsersArrayByUsernamesArray($usernames);

        $i = 0;
        foreach($ext_addresses_array as $ext_address)
        {
          $i++;
          $username = $ext_address['login'];

          $is_default = $ext_address['ab_default'];

          $company = $ext_address['ab_company_name'];
          $address_firstname = $ext_address['ab_firstname'];
          $address_lastname = $ext_address['ab_lastname'];

          $address_name = implode(' ', array($address_firstname, $address_lastname));
          if ($company && $company != '') {
            $address_name = $company.', '.$address_name;
          }

          $nip = $ext_address['ab_tax_id'];
          $street = $ext_address['ab_street_1'];
          $city = $ext_address['city'];
          $post_code = $ext_address['zip_code'];
          $region = $ext_address['state'];
          $country = $ext_address['country'];
          $phone = $ext_address['phone'];

          $user = $users[$username];

          if ($i%10 == 0) {
            echo 'Dodawanie adresu '.$i.' z '.$addresses_count.' : '.$username."\n";
          }

          $address = new Address();
          $address->setName($address_name);
          $address->setNip($nip);
          $address->setStreet($street);
          $address->setCity($city);
          $address->setPostCode($post_code);
          $address->setRegion($region);
          $address->setCountry($country);
          $address->setPhone($phone);
          $address->setProfileId($user->getProfile()->getPrimaryKey());
//var_dump($street);
          $address->save();
        }

        $ext_addresses->closeCursor();
      }
  }

}
