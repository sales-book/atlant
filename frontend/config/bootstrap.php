<?php

function GUID()
{
    if (function_exists('com_create_guid') === true) {
        return str_replace('-', '', strtolower(trim(com_create_guid(), '{}')));
    }
    return str_replace('-', '', strtolower(sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535))));
}