<?php
/*
 * Klasa ThemesView zmienia konfiguracje dla layout�w
 * Pobiera z bazy danych aktywny szablon
 * Szablony stron zjajduj� sie w katalogu 'web/themes/'
 */
class ThemesView extends sfPHPView
{

	//nazwa domy�lnego szablonu, �aduje sie jak nie ma szablon�w aktywnych w bazie
//	protected $defaultThemeDir = 'default';
	protected $defaultThemeDir = 'cafe';
	
	//obiekty aktywnego szablonu, poczatkowo 'false'
	protected $themeObject = false;
	
	//nazwa katalogu z aktywnym szablonem (r�wnoznaczna z nazwa szablonu)
	public $themeDir = '';
	
	//sciezka do katalogu ze wszystkimi szablonami (eg. 'web/themes/')
	public $themePath = '';
	
	//sciezka do aktywnego katalogu (eg. 'web/themes/default/')
	public $themeFullPath = '';

	//konfiguracja 'widoku' dla symfony (zmiana katalogu z layoutem)
	public function configure()
	{
		//pocz�tkowa konfiguracja z sfPHPView
	    parent::configure();
	
		//pobieranie obiektu aktywnego szablonu
		$this->themeObject = Doctrine::getTable('Themes')->getActiveTheme();
		
		//poranie nazwy aktywnego szablonu
		$this->themeDir = $this->themeObject->getName();
				
		//ustawienie sciezki do katalogu ze wszystkimi szablonami
		$this->themePath =  sfConfig::get('sf_web_dir').'/themes/';		
		
		//czy szablon ma plik 'layout.php'
		if(is_readable($this->themePath.$this->themeDir.'/layout.php'))
    {
			//ustawienie pe�nej siezki do aktywnego szablonu
			$this->themeFullPath = $this->themePath.$this->themeDir;
			
			//ustawienie w configu zmiennej ze sciezk� do aktywnego szablonu
			//potrzebna do wyswietlanie np. obrazk�w szablonu w layout.php
			sfConfig::add($param = array('themePath' => '/themes/'.$this->themeDir.'/'));
			
			//zmiana sciezki z 'frontend/template' na 'web/themes/nazwa_szablonu'
      $this->setDecoratorDirectory($this->themeFullPath);
		}
    else {
			//ustawienie domyslnego szablonu z $defaultThemeDir
			$this->setDecoratorDirectory($this->themePath.$this->defaultThemeDir);
		}

    // jeżeli theme jest inny niz domyślny
    if ($this->themeObject->getName() != $this->defaultThemeDir) {
      // jeżeli w module istnieje katalog templates_NAZWA_THEME
      if (file_exists($theme_templates_directory = $this->getDirectory().'/../templates_'.$this->themeObject->getName())) {
        // zmień scieżkę to szablonów
        $this->setDirectory($theme_templates_directory);
      }
    }
		
	}	
  
}