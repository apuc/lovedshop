<?php


namespace core\helpers;


use core\Debug;

class Form
{

    /**
     * @param string $name
     * @param array $data
     * @param array $options
     * @return string
     */
    public static function select(string $name, array $data, array $options):string
    {
        $params = self::generateAdditionalParams($options['attr']);
        $form = '<select name="'.$name.'" '.$params.'>';
        foreach ($data as $key => $datum){
            $selected = (isset($options['selected']) && $key == $options['selected']) ? 'selected' : '';
            $disabled = (isset($options['disabled']) && $key == $options['disabled']) ? 'disabled' : '';
            $form .= "<option $selected $disabled value='$key'>$datum</option>";
        }
        $form .= "</select>";

        return $form;
    }

    /**
     * @param string $name
     * @param array $options
     * @return string
     */
    public static function input(string $name, array $options):string
    {
        $params = self::generateAdditionalParams($options['attr']);
        $form = '<input name="'.$name.'" '.$params.'>';
        return $form;
    }

    /**
     * @param string $name
     * @param array $data
     * @param array $options
     * @return string
     */
    public static function checkBox(string $name, array $data, array $options):string
    {
        $params = self::generateAdditionalParams($options['attr']);
        $form = '';
        foreach ($data as $key => $datum){
            $selected = (isset($options['checked']) && $key == $options['checked']) ? 'checked' : '';
            $disabled = (isset($options['disabled']) && $key == $options['disabled']) ? 'disabled' : '';
            $form .= "<input type='checkbox' name='$name' $params $selected $disabled value='$key'>$datum</input></br>";
        }
        return $form;
    }

    /**
     * @param string $name
     * @param array $data
     * @param array $options
     * @return string
     */
    public static function radioButton(string $name, array $data, array $options):string
    {
        $params = self::generateAdditionalParams($options['attr']);
        $form = '';
        foreach ($data as $key => $datum){
            $selected = (isset($options['checked']) && $key == $options['checked']) ? 'checked' : '';
            $disabled = (isset($options['disabled']) && $key == $options['disabled']) ? 'disabled' : '';
            $form .= "<input type='radio' name=\"$name\" $params $selected $disabled value='$key'>$datum</input></br>";
        }
        return $form;
    }

    /**
     * @param string $name
     * @param array $options
     * @return string
     */
    public static function submitButton(string $name, array $options):string
    {
        $params = self::generateAdditionalParams($options['attr']);
        $form = "<input type='submit' name='$name' $params>";
        return $form;
    }

    /**
     * @param string $name
     * @param array $options
     * @return string
     */
    public static function start(string $name, array $options):string
    {
        $params = self::generateAdditionalParams($options['attr']);
        $form = '<form name="'.$name.'" '.$params.'>';
        return $form;
    }

    /**
     * @return string
     */
    public static function end():string
    {
        return '</form>';
    }

    /**
     * @param $data
     * @return string
     */
    private static function generateAdditionalParams($data)
    {
        $params = '';
        foreach ((array)$data as $key => $datum) {
            $params .= $key . '="' . $datum . '" ';
        }

        return $params;
    }

}