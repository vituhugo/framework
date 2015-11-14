<?php namespace Framework;

class Utilities
{
    const FORMAT_URL = "url-friendly";
    const FORMAT_UNDERSCORE = "underscore";
    const FORMAT_CAMELCASE = "CamelCase";
    const FORMAT_CAMELCASE_2 = "camelCase";
    const SEPARATOR_CAMELCASE = "|";

    public function formater($string, $format = self::FORMAT_CAMELCASE, $separador = ['-','_'])
    {
        if (false !== strstr($separador, self::SEPARATOR_CAMELCASE))
        {
            $name = strtolower(preg_replace('/([a-z])([A-Z])/', '$1|$2', $string));
        }

        $string_pieces = explode($separador, $string);

        switch ($format)
        {
            case self::FORMAT_URL:
                return strtolower(implode("-", $string_pieces));

            case self::FORMAT_UNDERSCORE:
                return strtolower(implode("_", $string_pieces));

            case self::FORMAT_CAMELCASE:
                return implode("", array_map('ucfirst', $string_pieces));

            case self::FORMAT_CAMELCASE_2:
                return lcfirst(implode("", array_map('ucfirst', $string_pieces)));
            default:
                return $string;
        }
    }
}