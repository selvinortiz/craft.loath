<?php
namespace Craft;

class LoathService extends BaseApplicationComponent
{
	protected $translator;
	
	public function __construct($translatorClass=null)
	{
		$translator = '\\Craft\\Craft';

		if (!is_null($translatorClass) && is_callable($translatorClass.'::t'))
		{
			$this->translator = $translatorClass;
		}
	}

	/**
	 * Returns the translated definition for the word hatred
	 *
	 * {Injects a static method dependency for Craft::t}
	 *
	 * @param	string	$translator	The name of the static class that defines t()
	 *
	 * @return	string
	 */
	public function getTranslatedDefinition(BaseModel $model)
	{
		if ($model->validate())
		{
			// Static method dependencies are just not elegant to work with
			// We can use $model->property but using $model->getAttribute('property') make this method more testable
			return call_user_func_array($this->translator.'::t', array($model->getAttribute('definition')));
		}

		return false;
	}

	/**
	 * Returns html as a Twig_Markup object to flag as safe and bypass escaping
	 *
	 * {Uses the craft()->templates dependency only if a charset is not provided}
	 *
	 * @param	string	$html
	 *
	 * @return	\Twig_Markup
	 */
	public function getSafeOutput($html, $charset=null)
	{
		if (is_null($charset))
		{
			$charset = craft()->templates->getTwig()->getCharset();
		}

		return new \Twig_Markup($html, $charset);
	}
}
