<?php

 

class extExampleHtml extends AbstractPage {
	
	public static function getSiteDisplayName() {
		return 'Example Extension - HTML';
	}

	public function __construct($request = [], $extension = []) {
		parent::__construct(array( self::getSiteDisplayName() ), false, false, false, $request, $extension);
		$this->checkLogin();
	}

	public function execute() {

		//$this->getRequest();
		//$this->getAcl();

		
		$this->render([
			"tmplHTML" => "<div>Hier wird plain HTML angezeigt !!!</div>"
		]);

	}

}
