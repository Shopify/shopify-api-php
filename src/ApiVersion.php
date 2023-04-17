<?php

declare(strict_types=1);

namespace Shopify;

class ApiVersion
{
    /** @var string */
    public const UNSTABLE = "unstable";
    /** @var string */
    public const JANUARY_2022 = "2022-01";
    /** @var string */
    public const APRIL_2022 = "2022-04";
    /** @var string */
    public const JULY_2022 = "2022-07";
    /** @var string */
    public const OCTOBER_2022 = "2022-10";
    /** @var string */
    public const JANUARY_2023 = "2023-01";
    /** @var string */
    public const APRIL_2023 = "2023-04";
    /** @var string */
    public const LATEST = self::APRIL_2023;

    private static $ALL_VERSIONS = [
        self::UNSTABLE,
        self::JANUARY_2022,
        self::APRIL_2022,
        self::JULY_2022,
        self::OCTOBER_2022,
        self::JANUARY_2023,
        self::APRIL_2023,
    ];

    public static function isValid(string $version): bool
    {
        return in_array($version, self::$ALL_VERSIONS);
    }
}
