<?php



class extExampleDefault extends AbstractPage {
	
	public static function getSiteDisplayName() {
		return 'Example Extension - Default';
	}

	public function __construct($request = [], $extension = []) {
		parent::__construct(array( self::getSiteDisplayName() ), false, false, false, $request, $extension);
		$this->checkLogin();
	}


	public function execute() {

		//$this->getRequest();
		//$this->getAcl();

		$text = "Der Text kommt aus php";

		$this->render([
			"tmpl" => "default",
            "vars" => [
              "mytext" => $text
            ],
			"dropdown" => [
				[
					"url" => "index.php?page=example&task=print",
					"title" => "Drucken",
					"icon" => "fas fa-print"
				]
			]
		]);

	}

	/**
	 * Example Task Function
	 */
	public function taskPrint() {

		// Mach hier etwas cooles!!!

		$this->reloadWithoutParam('task');
	}

}
