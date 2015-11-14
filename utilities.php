<?php namespace Framework;

class Utilities
{
    const FORMAT_URL = "url-friendly";
    const FORMAT_UNDERSCORE = "underscore";
    const FORMAT_CAMELCASE = "CamelCase";
    const FORMAT_CAMELCASE_2 = "camelCase";
    const SEPARATOR_CAMELCASE = "|";

    public function formater($string, $format = FORMAT_CAMELCASE, $separador = ['-','_'])
    {
        if (false !== strstr($separador, SEPARATOR_CAMELCASE))
        {
            $name = strtolower(preg_replace('/([a-z])([A-Z])/', '$1|$2', $string));
        }

        $string_pieces = explode($separador, $string);

        switch ($format)
        {
            case FORMAT_URL:
                return strtolower(implode("-", $string_pieces));

            case FORMAT_UNDERSCORE:
                return strtolower(implode("_", $string_pieces));

            case FORMAT_CAMELCASE:
                return implode("", array_map('ucfirst', $string_pieces));

            case FORMAT_CAMELCASE_2:
                return lcfirst(implode("", array_map('ucfirst', $string_pieces)));
        }
        throw new \Exception('Formato n�o existe');
    }
}