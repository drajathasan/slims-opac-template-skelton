<?php

if (!function_exists('xf')) {
    function xf(string $char) {
        return str_replace(['\'', '"', '', strip_tags($char)]);
    }
}