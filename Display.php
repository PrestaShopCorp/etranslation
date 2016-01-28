<?php
/**
 * etranslation traduction agence  
 * 
 * @author    contact@dream-it.ma>
 * @copyright 2015, Dream-it
 * @license   http://www.opensource.org/licenses/MIT
*/


class BWDisplay extends FrontController
{
	// Assign template, on 1.4 create it else assign for 1.5
	public function setTemplate($template)
	{
		if (_PS_VERSION_ >= '1.5')
			parent::setTemplate($template);
		else
			$this->template = $template;
	}

	// Overload displayContent for 1.4
	public function displayContent()
	{
		parent::displayContent();

		echo Context::getContext()->smarty->fetch($this->template);
	}
}
