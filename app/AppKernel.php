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

// phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

/**
 * Widgets Demo Symfony App Kernel
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class AppKernel extends Kernel
{
    /**
     * {@inheritdoc}
     */
    public function registerBundles()
    {
        //==============================================================================
        // SYMFONY CORE
        $bundles[] = new Symfony\Bundle\FrameworkBundle\FrameworkBundle();
        $bundles[] = new Symfony\Bundle\SecurityBundle\SecurityBundle();
        $bundles[] = new Symfony\Bundle\TwigBundle\TwigBundle();
        $bundles[] = new Twig\Extra\TwigExtraBundle\TwigExtraBundle();
        $bundles[] = new Symfony\WebpackEncoreBundle\WebpackEncoreBundle();
        $bundles[] = new Symfony\Bundle\MonologBundle\MonologBundle();

        //==============================================================================
        // SYMFONY BUNDLES
        $bundles[] = new BadPixxel\Md2Pdf\Bundle\Md2PdfBundle();

        //==============================================================================
        // TEST & DEV BUNDLES
        if (in_array($this->getEnvironment(), array('dev', 'test'), true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();

            if ('dev' === $this->getEnvironment()) {
                $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            }

            if (('dev' === $this->getEnvironment())
                && class_exists("\\Symfony\\Bundle\\WebServerBundle\\WebServerBundle")) {
                $bundles[] = new Symfony\Bundle\WebServerBundle\WebServerBundle();
            }
        }

        return $bundles;
    }

    /**
     * {@inheritdoc}
     */
    public function getRootDir()
    {
        return __DIR__;
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheDir()
    {
        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
    }

    /**
     * {@inheritdoc}
     */
    public function getLogDir()
    {
        return dirname(__DIR__).'/var/logs';
    }

    /**
     * {@inheritdoc}
     */
    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
        if ("test" == $this->getEnvironment()) {
            $loader->load($this->getRootDir().'/config_test.yml');
        } else {
            $loader->load($this->getRootDir().'/config.yml');
        }
    }
}
