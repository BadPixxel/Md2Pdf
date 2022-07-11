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
 * Storage for Documents Settings
 */
trait SettingsTrait
{
    /**
     * @var array<string, mixed>
     */
    private array $settings = array();

    /**
     * Get All Settings
     *
     * @return array<string, mixed>
     */
    public function getSettings(): array
    {
        return $this->settings;
    }

    /**
     * Set One Setting
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return self
     */
    public function setSetting(string $key, $value): self
    {
        $this->settings[$key] = $value;

        return $this;
    }

    /**
     * Set All Settings.
     *
     * @param array<string, mixed> $settings
     *
     * @return self
     */
    public function setSettings(array $settings): self
    {
        $this->settings = array_replace_recursive($this->settings, $settings);

        return $this;
    }
}
