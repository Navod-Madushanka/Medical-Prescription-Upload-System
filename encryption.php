<?php

class Encryption {
    public static function encrypt($source) {
        $md5 = md5($source);
        return $md5;
    }
}

?>