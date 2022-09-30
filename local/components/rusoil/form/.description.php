<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
$arComponentDescription = [
    "NAME" => GetMessage("FORM"),
    "DESCRIPTION" => GetMessage("FORM_DESCRIPTION"),
    "ICON" => "/images/icon.gif",
    "CACHE_PATH" => "Y",
    "PATH" => [
        "ID" => "service",
        "CHILD" => [
            "ID" => "form",
            "NAME" => GetMEssage("FORM_SERVICE"),
        ],
    ],
];