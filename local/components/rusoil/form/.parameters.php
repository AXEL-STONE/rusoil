<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc as Loc;

$arComponentParameters = [
    "GROUPS" => [
    ],
    "PARAMETERS" => [
        "EMAIL_TO" => [
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage("EMAIL_TO"),
            "TYPE" => "STRING",
            "DEFAULT" => "test@site.com",
        ],
        "CATEGORY_FIELD" => [
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage("CATEGORY_FIELD"),
            "TYPE" => "STRING",
            'MULTIPLE' => 'Y',
            "DEFAULT" => [
                Loc::getMessage("CATEGORY_DEFAULT_VALUE_1"),
                Loc::getMessage("CATEGORY_DEFAULT_VALUE_2"),
            ],
            "ADDITIONAL_VALUES" => "Y",
        ],
        "VIEW_FIELD" => [
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage("VIEW_FIELD"),
            "TYPE" => "STRING",
            'MULTIPLE' => 'Y',
            "DEFAULT" => [
                Loc::getMessage("VIEW_DEFAULT_VALUE_1"),
                Loc::getMessage("VIEW_DEFAULT_VALUE_2"),
                Loc::getMessage("VIEW_DEFAULT_VALUE_3"),
            ],
            "ADDITIONAL_VALUES" => "Y",
        ],
        "STOCK_FIELD" => [
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage("STOCK_FIELD"),
            "TYPE" => "STRING",
            'MULTIPLE' => 'Y',
            "DEFAULT" => [
                Loc::getMessage("STOCK_DEFAULT_VALUE_1"),
                Loc::getMessage("STOCK_DEFAULT_VALUE_2"),
                Loc::getMessage("STOCK_DEFAULT_VALUE_3"),
            ],
            "ADDITIONAL_VALUES" => "Y",
        ],
        "BRAND_FIELD" => [
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage("BRAND_FIELD"),
            "TYPE" => "STRING",
            'MULTIPLE' => 'Y',
            "DEFAULT" => [
                Loc::getMessage("BRAND_DEFAULT_VALUE_1"),
                Loc::getMessage("BRAND_DEFAULT_VALUE_2"),
                Loc::getMessage("BRAND_DEFAULT_VALUE_3"),
            ],
            "ADDITIONAL_VALUES" => "Y",
        ],
        "MAKE_FIELD" => [
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage("MAKE_FIELD"),
            "TYPE" => "STRING",
            'MULTIPLE' => 'Y',
            "DEFAULT" => [
                Loc::getMessage("MAKE_DEFAULT_VALUE_NAME"),
                Loc::getMessage("MAKE_DEFAULT_VALUE_COUNT"),
                Loc::getMessage("MAKE_DEFAULT_VALUE_PACK"),
                Loc::getMessage("MAKE_DEFAULT_VALUE_CLIENT"),
            ],
            "ADDITIONAL_VALUES" => "Y",
        ],
    ],
];