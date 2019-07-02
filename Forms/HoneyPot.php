<?php

namespace Pingu\HoneyPot\Forms;

use Pingu\Forms\Support\Field;

class HoneyPot extends Field{

	public function render(){
		echo \FormFacade::text($this->name, null, ['id' => 'my-very-nice-email']);
	}

	/**
	 * @inheritDoc
	 */
	public function getDefaultView()
	{
		return 'forms::fields.'.$this->getType();
	}

}