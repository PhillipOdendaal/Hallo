<?php

namespace app\components;

use DOMDocument;
use DOMXPath;
use SimpleXMLElement;
use Yii;
use yii\web\Session;

class Utils {

    public static function getAttrMaxLengthFromAttr($model, $attr) {

        foreach ($model->rules() as $rule) {

            if (isset($rule["max"])) {
                $max_len = $rule["max"];

                if (isset($rule[0])) {
                    foreach ($rule[0] as $attrname) {
                        if ($attrname == $attr) {
                            return $rule["max"];
                        }
                    }
                }
            }
        }

        return null;
    }

    public static function FormatXML($string_xml, $removewhitespace = false) {

        if (!empty($string_xml)) {
            if ($removewhitespace) {
                $string_xml = str_replace("\n", "", $string_xml);
                $string_xml = str_replace("\r", "", $string_xml);
                
                $string_xml = preg_replace('~\s*(<([^>]*)>[^<]*</\2>|<[^>]*>)\s*~', '$1', $string_xml);
            }

            $customXML = new SimpleXMLElement($string_xml);
            $dom = dom_import_simplexml($customXML);

            $dom->ownerDocument->preserveWhiteSpace = false;
            $dom->ownerDocument->formatOutput = !$removewhitespace ? true : false;

            return $dom->ownerDocument->saveXML($dom->ownerDocument->documentElement);
        }
        else {
            return null;
        }
    }

    public static function pivotAssocArray($rows) {
        $new_row = [];

        foreach ($rows as $row) {
            $keys = array_keys($row);


            $first_val = $row[$keys[0]];
            $second_val = $row[$keys[1]];

            $new_row[$first_val] = $second_val;
        }

        return $new_row;
    }

    public static function redirect($url, $statusCode = 302) {
        return Yii::$app->getResponse()->redirect($url, $statusCode);
    }

    public static function isCLI() {
        return php_sapi_name() == "cli";
    }

    public static function getSession($ses) {

        if (static::isCLI()) {
            return null;
        }

        $session = new Session();
        $session->open();

        $session_value = $session->get($ses);

        // $session_value = isset($session->get($ses)) ? $session->get($ses) : null;

        $session->close();
        $session = null;

        return $session_value;
    }

    public static function setSession($ses, $val = NULL) {
		
        if (static::isCLI()) {
            return null;
        }
		
        $session = new Session();
        $session->open();
        $session->set($ses, $val);
        $session->close();
    }

    public static function registerAssetFile($view, $path, $js_script_pos = yii\web\View::POS_END, $depends = "app\assets\AppAsset") {

        if (substr($path, strlen($path) - 3) == ".js") {
            $view->registerJsFile($path, [
                'position' => $js_script_pos,
                'depends' => [$depends]
            ]);
        }

        if (substr($path, strlen($path) - 4) == ".css") {
            $view->registerCssFile($path, [
                'depends' => [$depends]
            ]);
        }
    }

    public static function registerAssets($view, $assets_folder_path, $assets, $js_script_pos = yii\web\View::POS_END, $force_republish = false, $only_publish_related_assets = false, $depends = "app\assets\AppAsset") {

        $assets_absolute_path = realpath(Yii::getAlias('@app') . "/" . $assets_folder_path);

        $publishOptions = [
            'forceCopy' => YII_ENV_DEV ? true : $force_republish
        ];

        if (!is_array($assets)) {
            $assets = array($assets);
        }


        if ($only_publish_related_assets) {


            foreach ($assets as $asset) {

                $asset_full_path = $assets_absolute_path . "/" . $asset;
                $assetmanager_result = Yii::$app->assetManager->publish($asset_full_path, $publishOptions);
                $published_asset_path = $assetmanager_result[1];

                static::registerAssetFile($view, $published_asset_path, $js_script_pos, $depends);
            }
        }
        else {

            $assetmanager_result = Yii::$app->assetManager->publish($assets_absolute_path, $publishOptions);
            $assets_path = $assetmanager_result[1];

            if (count($assets) > 0) {
                foreach ($assets as $asset) {
                    static::registerAssetFile($view, $assets_path . '/' . $asset, $js_script_pos, $depends);
                }
            }
        }
    }

    public static function session_serialize(array $data) {
        $temp = $_SESSION;
        $_SESSION = $data;
        $out = session_encode();
        $_SESSION = $temp;
        return $out;
    }

    public static function unserialize_session($session_data) {
        $method = ini_get("session.serialize_handler");
        switch ($method) {
            case "php":
                return self::unserialize_php_session($session_data);
                break;
            case "php_binary":
                return self::unserialize_phpbinary_session($session_data);
                break;
            default:
                throw new Exception("Unsupported session.serialize_handler: " . $method . ". Supported: php, php_binary");
        }
    }

    private static function unserialize_php_session($session_data) {
        $return_data = array();
        $offset = 0;
        while ($offset < strlen($session_data)) {
            if (!strstr(substr($session_data, $offset), "|")) {
                throw new Exception("invalid data, remaining: " . substr($session_data, $offset));
            }
            $pos = strpos($session_data, "|", $offset);
            $num = $pos - $offset;
            $varname = substr($session_data, $offset, $num);
            $offset += $num + 1;
            $data = unserialize(substr($session_data, $offset));
            $return_data[$varname] = $data;
            $offset += strlen(serialize($data));
        }
        return $return_data;
    }

    private static function unserialize_phpbinary_session($session_data) {
        $return_data = array();
        $offset = 0;
        while ($offset < strlen($session_data)) {
            $num = ord($session_data[$offset]);
            $offset += 1;
            $varname = substr($session_data, $offset, $num);
            $offset += $num;
            $data = unserialize(substr($session_data, $offset));
            $return_data[$varname] = $data;
            $offset += strlen(serialize($data));
        }
        return $return_data;
    }

}
