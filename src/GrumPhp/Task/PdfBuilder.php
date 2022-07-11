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

namespace BadPixxel\Md2Pdf\GrumPhp\Task;

use GrumPHP\Configuration\GrumPHP;
use GrumPHP\Formatter\ProcessFormatterInterface as Formater;
use GrumPHP\Process\ProcessBuilder;
use GrumPHP\Runner\TaskResult;
use GrumPHP\Runner\TaskResultInterface;
use GrumPHP\Task\AbstractExternalTask;
use GrumPHP\Task\Context\ContextInterface;
use GrumPHP\Task\Context\GitPreCommitContext;
use GrumPHP\Task\Context\RunContext;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * GrumPhp Task: BadPixxel Php Module Builder
 *
 * Generate Installable Zip file for Module
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class PdfBuilder extends AbstractExternalTask
{
    /**
     * @var array
     */
    private array $options;

    /**
     * @param ProcessBuilder $processBuilder
     * @param Formater       $formatter
     */
    public function __construct(ProcessBuilder $processBuilder, Formater $formatter)
    {
        parent::__construct($processBuilder, $formatter);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'build-module';
    }

    /**
     * @return OptionsResolver
     */
    public static function getConfigurableOptions(): OptionsResolver
    {
        $resolver = new OptionsResolver();
        $resolver->setDefaults(
            array(
                'enabled' => true,
            )
        );

        $resolver->addAllowedTypes('enabled', array('boolean'));

        return $resolver;
    }

    /**
     * {@inheritdoc}
     */
    public function canRunInContext(ContextInterface $context): bool
    {
        return ($context instanceof GitPreCommitContext || $context instanceof RunContext);
    }

    /**
     * {@inheritdoc}
     */
    public function run(ContextInterface $context): TaskResultInterface
    {
        //====================================================================//
        // Load Task Configuration
        $this->options = $this->getConfig()->getOptions();
        //====================================================================//
        // Build Disabled => Skip this Task
        if (!$this->options["enabled"]) {
            return TaskResult::createPassed($this, $context);
        }

        return TaskResult::createPassed($this, $context);
    }
}
