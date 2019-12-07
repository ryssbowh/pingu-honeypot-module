<?php

namespace Pingu\HoneyPot\Forms;

use Pingu\Forms\Support\Field;

class HoneyPot extends Field
{

    public function __toString()
    {
        echo \FormFacade::text($this->name, null, ['id' => 'my-very-nice-email']);
    }

}