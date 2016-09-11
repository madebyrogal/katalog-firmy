<?php

class AddCompanyFrontendForm extends sfForm
{

    private $packet = 2;
    private $star = '<span class="star">* </span> ';

    public function setPacket($packet)
    {
        $this->packet = $packet;
        $this->setDefault('packet', $this->packet);
    }

    public function configure()
    {
        $this->widgetSchema['name'] = new sfWidgetFormInput();
        $this->validatorSchema['name'] = new sfValidatorString(array('required' => true));
        $this->widgetSchema['name']->setLabel($this->star.'Pełna nazwa firmy');

        $this->widgetSchema['nip'] = new sfWidgetFormInput();
        $this->validatorSchema['nip'] = new sfValidatorString(array('required' => true));
        $this->widgetSchema['nip']->setLabel($this->star.'NIP');

        $this->widgetSchema['city'] = new sfWidgetFormInput();
        $this->validatorSchema['city'] = new sfValidatorString(array('required' => true));
        $this->widgetSchema['city']->setLabel($this->star.'Miejscowość');

        $state = array();
        $state[''] = "[ Wybierz województwo ]";
        $state['dolnośląskie'] = "dolnośląskie";
        $state['kujawsko-pomorskie'] = "kujawsko-pomorskie";
        $state['lubelskie'] = "lubelskie";
        $state['lubuskie'] = "lubuskie";
        $state['łódzkie'] = "łódzkie";
        $state['małopolskie'] = "małopolskie";
        $state['mazowieckie'] = "mazowieckie";
        $state['opolskie'] = "opolskie";
        $state['podkarpackie'] = "podkarpackie";
        $state['podlaskie'] = "podlaskie";
        $state['pomorskie'] = "pomorskie";
        $state['śląskie'] = "śląskie";
        $state['świętokrzyskie'] = "świętokrzyskie";
        $state['warmińsko-mazurskie'] = "warmińsko-mazurskie";
        $state['wielkopolskie'] = "wielkopolskie";
        $state['zachodniopomorskie'] = "zachodniopomorskie";

        $this->widgetSchema['state'] = new sfWidgetFormChoice(
          array(
             'choices' => $state
          ));
        $this->validatorSchema['state'] = new sfValidatorString(array('required' => true));
        $this->widgetSchema['state']->setLabel($this->star.'Województwo');

        $this->widgetSchema['post_code'] = new sfWidgetFormInput();
        $this->validatorSchema['post_code'] = new sfValidatorString();
        $this->widgetSchema['post_code']->setLabel($this->star.'Kod pocztowy');

        $this->widgetSchema['street'] = new sfWidgetFormInput();
        $this->validatorSchema['street'] = new sfValidatorString(array('required' => true));
        $this->widgetSchema['street']->setLabel($this->star.'Ulica i numer posesji');

        $this->widgetSchema['phone'] = new sfWidgetFormInput();
        $this->validatorSchema['phone'] = new sfValidatorString(array('required' => true));
        $this->widgetSchema['phone']->setLabel($this->star.'Telefon');

        $this->widgetSchema['mobile'] = new sfWidgetFormInput();
        $this->validatorSchema['mobile'] = new sfValidatorString(array('required' => false));        
        $this->widgetSchema['mobile']->setLabel('Telefon (opcjonalnie)');
        
        
        $this->widgetSchema['email_address'] = new sfWidgetFormInput();
        $this->widgetSchema['email_address']->setLabel('E-mail');
        
        $this->validatorSchema['email_address'] = new sfValidatorEmail(array('trim' => true, 'required' => false));
        
        $this->widgetSchema['fax'] = new sfWidgetFormInput();
        $this->validatorSchema['fax'] = new sfValidatorString(array('required' => false));
        $this->widgetSchema['fax']->setLabel('Fax');
        
        /*$this->widgetSchema['gg'] = new sfWidgetFormInput();
        $this->validatorSchema['gg'] = new sfValidatorString(array('required' => false));
        $this->widgetSchema['gg']->setLabel('GG');
        
        $this->widgetSchema['skype'] = new sfWidgetFormInput();
        $this->validatorSchema['skype'] = new sfValidatorString(array('required' => false));
        $this->widgetSchema['skype']->setLabel('Skype');*/
        
        $this->widgetSchema['fb'] = new sfWidgetFormInput();
        $this->validatorSchema['fb'] = new sfValidatorString(array('required' => false));
        $this->widgetSchema['fb']->setLabel('Facebook');
        
        $this->widgetSchema['yt'] = new sfWidgetFormInput();
        $this->validatorSchema['yt'] = new sfValidatorString(array('required' => false));
        $this->widgetSchema['yt']->setLabel('Youtube');
        
        $this->widgetSchema['www'] = new sfWidgetFormInput();
        $this->validatorSchema['www'] = new sfValidatorString(array('required' => false));
        $this->widgetSchema['www']->setLabel('Adres WWW');

        $types = TypeTable::getInstance()->getOptionChoices();
        $this->widgetSchema['types'] = new sfWidgetFormChoice(
          array(
             'choices' => $types,
             'expanded' => true,
             'multiple' => true
          ));

        $this->widgetSchema['types']->setLabel(false);
        $this->validatorSchema['types'] = new sfValidatorChoice(array(
            'choices' => array_keys($types),
            'multiple' => true
        ));

        $this->widgetSchema['company_categories_list'] = new sfWidgetFormDoctrineChoice(
          array(
             'model' => 'Category',
             'add_empty' => false,
             'order_by' => array('root_id, lft', ''),
             'method' => 'getIndentedName',
             'multiple' => true
          ));
        
        $this->widgetSchema['company_categories_list']->setLabel(false);
        
        $this->validatorSchema['company_categories_list'] = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Category', 'required' => true));

        $this->widgetSchema['profile_first_name'] = new sfWidgetFormInput();
        $this->validatorSchema['profile_first_name'] = new sfValidatorString(array('required' => true));
        $this->widgetSchema['profile_first_name']->setLabel($this->star.'Imię');

        $this->widgetSchema['profile_last_name'] = new sfWidgetFormInput();
        $this->validatorSchema['profile_last_name'] = new sfValidatorString(array('required' => true));
        $this->widgetSchema['profile_last_name']->setLabel($this->star.'Nazwisko');

        $this->widgetSchema['profile_phone'] = new sfWidgetFormInput();
        $this->validatorSchema['profile_phone'] = new sfValidatorString(array('required' => true));
        $this->widgetSchema['profile_phone']->setLabel($this->star.'Telefon');

        $this->widgetSchema['profile_name'] = new sfWidgetFormInput();
        $this->validatorSchema['profile_name'] = new sfValidatorString(array('required' => true));
        $this->widgetSchema['profile_name']->setLabel($this->star.'Pełna nazwa firmy');

        $this->widgetSchema['profile_nip'] = new sfWidgetFormInput();
        $this->validatorSchema['profile_nip'] = new sfValidatorString(array('required' => true));
        $this->widgetSchema['profile_nip']->setLabel($this->star.'NIP');

        $this->widgetSchema['profile_city'] = new sfWidgetFormInput();
        $this->validatorSchema['profile_city'] = new sfValidatorString(array('required' => true));
        $this->widgetSchema['profile_city']->setLabel($this->star.'Miejscowość');

        $state = array();
        $state[''] = "[ Wybierz województwo ]";
        $state['dolnośląskie'] = "dolnośląskie";
        $state['kujawsko-pomorskie'] = "kujawsko-pomorskie";
        $state['lubelskie'] = "lubelskie";
        $state['lubuskie'] = "lubuskie";
        $state['łódzkie'] = "łódzkie";
        $state['małopolskie'] = "małopolskie";
        $state['mazowieckie'] = "mazowieckie";
        $state['opolskie'] = "opolskie";
        $state['podkarpackie'] = "podkarpackie";
        $state['podlaskie'] = "podlaskie";
        $state['pomorskie'] = "pomorskie";
        $state['śląskie'] = "śląskie";
        $state['świętokrzyskie'] = "świętokrzyskie";
        $state['warmińsko-mazurskie'] = "warmińsko-mazurskie";
        $state['wielkopolskie'] = "wielkopolskie";
        $state['zachodniopomorskie'] = "zachodniopomorskie";

        $this->widgetSchema['profile_state'] = new sfWidgetFormChoice(
          array(
             'choices' => $state
          ));
        $this->validatorSchema['profile_state'] = new sfValidatorString(array('required' => true));
        $this->widgetSchema['profile_state']->setLabel($this->star.'Województwo');

        $this->widgetSchema['profile_post_code'] = new sfWidgetFormInput();
        $this->validatorSchema['profile_post_code'] = new sfValidatorString();
        $this->widgetSchema['profile_post_code']->setLabel($this->star.'Kod pocztowy');

        $this->widgetSchema['profile_street'] = new sfWidgetFormInput();
        $this->validatorSchema['profile_street'] = new sfValidatorString(array('required' => true));
        $this->widgetSchema['profile_street']->setLabel($this->star.'Ulica i numer posesji');

        $this->widgetSchema['email'] = new sfWidgetFormInput();
        $this->widgetSchema['email']->setLabel('E-mail');
        
        $this->widgetSchema['password'] = new sfWidgetFormInputPassword();
        $this->widgetSchema['password2'] = new sfWidgetFormInputPassword();
        $this->widgetSchema['password']->setLabel('Hasło');
        $this->widgetSchema['password2']->setLabel('Powtórz hasło');

        $this->validatorSchema['email'] = new sfValidatorAnd(array(
                new sfValidatorEmail(array('trim' => true, 'required' => true),
                  array('invalid' => 'Wpisz poprawny adres e-mail.')),
                new sfValidatorString(array('min_length' => 3, 'max_length' => 127, 'trim' => true, 'required' => true, )),
                new sfValidatorDoctrineUnique(array('model' => 'sfGuardUser', 'column' => 'email_address'),
                  array('invalid' => 'Taki email jest już zajęty'))
              ));

        $this->validatorSchema['password'] = new sfValidatorString(array('min_length' => 3, 'required' => true, 'trim' => true, 'max_length' => 128), array('min_length' => 'Hasło musi zawierać co najmniej %min_length% znaki.'));
        $this->validatorSchema['password2'] = new sfValidatorString(array('min_length' => 3, 'required' => true, 'trim' => true, 'max_length' => 128));

        $this->setPasswordEqualValidator();
				
				$this->widgetSchema['packet'] = new sfWidgetFormInputHidden();
				$this->validatorSchema['packet'] = new sfValidatorDoctrineChoice(array(
						'model' => 'Prices',
				));

//        $this->widgetSchema['packet'] = new sfWidgetFormChoice(array(
//            'choices' => PricesTable::getInstance()->getDefaultPacketsId(),
//            'expanded' => true
//        ));
//        $this->widgetSchema['packet']->setLabel(false);
//        $this->validatorSchema['packet'] = new sfValidatorChoice(array(
//            'choices' => array_keys(PricesTable::getInstance()->getDefaultPacketsId())
//        ));
        $this->setDefault('packet', $this->packet);
        
        $this->widgetSchema['reg'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['reg'] = new sfValidatorBoolean(array('required' => true));
        
        $articles = ArticlesTable::getInstance()->find(4);
        $url = T::url_for('articles_show', $articles);
        $this->widgetSchema['reg']->setLabel('akceptuję <a target="blank" href="'.$url.'">regulamin</a>');
        
        $this->widgetSchema['check'] = new sfWidgetFormInputCheckbox();
        $this->validatorSchema['check'] = new sfValidatorBoolean(array('required' => false));
    }

    protected function setPasswordEqualValidator()
    {
        $schema = $this->validatorSchema;
        $postValidator = $schema->getPostValidator();

        $postValidators = array(
          new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'password2', array(),
            array('invalid' => 'Hasła muszą być jednakowe.')
          ),
        );

        if ($postValidator) {
          $postValidators[] = $postValidator;
        }

        $this->validatorSchema->setPostValidator(new sfValidatorAnd($postValidators));
    }

}