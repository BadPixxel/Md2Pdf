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

namespace BadPixxel\Md2Pdf\Models\PdfDocument;

/**
 * Generic Commons Metadata for a Pdf Document
 */
trait MetadataTrait
{
    /**
     * @var string
     */
    private string $name = "Pdf Document";

    /**
     * @var string
     */
    private string $title = "Pdf Document";

    /**
     * @var null|string
     */
    private ?string $subtitle = null;

    /**
     * @var null|string
     */
    private ?string $licence = null;

    /**
     * @var null|string
     */
    private ?string $description = null;

    /**
     * @var null|string
     */
    private ?string $logo = null;

    /**
     * Use Fontawesome
     *
     * @var bool
     */
    private bool $useFontawesome = false;

    /**
     * Code Highlight Theme
     *
     * @see https://github.com/scrivo/highlight.php
     *
     * @var string
     */
    private string $highlightTheme = "atom-one-dark";

    //====================================================================//
    // GENERIC GETTERS & SETTERS
    //====================================================================//

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    /**
     * @param null|string $subtitle
     *
     * @return self
     */
    public function setSubtitle(?string $subtitle): self
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getLicence(): ?string
    {
        return $this->licence;
    }

    /**
     * @param null|string $licence
     *
     * @return self
     */
    public function setLicence(?string $licence): self
    {
        $this->licence = $licence;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param null|string $description
     *
     * @return self
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getLogo(): ?string
    {
        return $this->logo;
    }

    /**
     * @param null|string $logo
     *
     * @return self
     */
    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * @return bool
     */
    public function isUseFontawesome(): bool
    {
        return $this->useFontawesome;
    }

    /**
     * @param bool $useFontawesome
     *
     * @return self
     */
    public function setUseFontawesome(bool $useFontawesome): self
    {
        $this->useFontawesome = $useFontawesome;

        if ($useFontawesome) {
            $this->setDomPdfOptions(array("isRemoteEnabled" => true));
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getHighlightTheme(): string
    {
        return $this->highlightTheme;
    }

    /**
     * @param string $theme
     *
     * @return self
     */
    public function setHighlightTheme(string $theme): self
    {
        $this->highlightTheme = $theme;

        return $this;
    }
}
