<?php

/*
 *  Copyright (C) BadPixxel <www.badpixxel.com>
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace BadPixxel\Md2Pdf\Models\Styles;

use BadPixxel\Md2Pdf\Models\AbstractPdfDocument;

/**
 * Styles Helper for Splash Sync Documents
 */
class SplashSyncStyle
{
    /** @var string  */
    private static string $name = "Splash Sync SAS";
    /** @var string  */
    private static string $website = "www.splashsync.com";
    /** @var string  */
    private static string $email = "contact@splashsync.com";

    /**
     * @var array<string, string>
     */
    private static array $cssColors = array(
        "primary-color" => "#FE9900",
        "secondary-color" => "Gainsboro",
        //        "danger-color" => "#f00114",
        //        "warning-color" => "#e3c702",
        //        "info-color" => "#d6522d",
        //        "success-color" => "#029a50",
        //        "light-color" => "Black",
        //        "white-color" => "#ffffff",
        //        "dark-color" => "#000000",
    );

    /**
     * @param AbstractPdfDocument $document
     *
     * @return void
     */
    public static function setupStyles(AbstractPdfDocument $document): void
    {
        //====================================================================//
        // Set-up Pdf Styles
        $document->setDomPdfCssVariables(self::$cssColors);
        $document->setStyles("Styles\\splashsync.html.twig");
        //====================================================================//
        // Set-up Pdf Header
        $document->setHeader("Blocks/Default/header.html.twig");
        //====================================================================//
        // Set-up Pdf Footer
        $document->setFooter("Blocks/Default/footer.html.twig");
        //====================================================================//
        // Set-up Splash Informations
        $document->setLicence(self::getLicence());
        $document->setLogo(dirname(__DIR__, 3)."/src/Bundle/Resources/public/img/splash-logo.png");
    }

    /**
     * Get Splash Generic Metadata
     *
     * @return array<string, string>
     */
    public static function getGenericMetadata(): array
    {
        return array(
            "author" => "**Author:** ".self::$name,
            "website" => self::$website,
            "email" => self::$email,
        );
    }

    /**
     * Generate File Licence
     *
     * @return string
     */
    public static function getLicence(): string
    {
        $licence = '<span class="text-primary">Splash Sync SAS</span>';
        $licence .= "&nbsp;|&nbsp;www.splashsync.com";

        return $licence;
    }
}
