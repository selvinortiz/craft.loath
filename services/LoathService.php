<?php
namespace Craft;

class LoathService extends BaseApplicationComponent
{
	/**
	 * Returns the translated definition for the word hatred
	 *
	 * {Injects a static method dependency for Craft::t}
	 *
	 * @param	string	$translator	The name of the static class that defines t()
	 *
	 * @return	string
	 */
	public function getHatredDefinition($translator=null)
	{
		$definition = 'Intense dislike or ill will.';

		if (is_null($translator) || !is_callable($translator.'::t'))
		{
			return Craft::t($definition);
		}

		return call_user_func_array($translator.'::t', array($definition));
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
