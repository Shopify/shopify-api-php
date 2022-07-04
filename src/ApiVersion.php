<?php

declare(strict_types=1);

namespace Shopify;

class ApiVersion
{
    /** @var string */
    public const UNSTABLE = "unstable";
    /** @var string */
    public const OCTOBER_2021 = "2021-10";
    /** @var string */
    public const JANUARY_2022 = "2022-01";
    /** @var string */
    public const APRIL_2022 = "2022-04";
    /** @var string */
    public const JULY_2022 = "2022-07";
    /** @var string */
    public const LATEST = self::JULY_2022;

    private static $ALL_VERSIONS = [
        self::UNSTABLE,
        self::OCTOBER_2021,
        self::JANUARY_2022,
        self::APRIL_2022,
        self::JULY_2022,
    ];

    public static function isValid(string $version): bool
    {
        return in_array($version, self::$ALL_VERSIONS);
    }
}
