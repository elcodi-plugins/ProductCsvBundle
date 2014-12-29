<?php

/*
 * This file is part of the Elcodi package.
 *
 * Copyright (c) 2014 Elcodi.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 * @author Marc Morera <yuhu@mmoreram.com>
 * @author Aldo Chiecchia <zimage@tiscali.it>
 */

namespace Elcodi\Plugin\ProductCsv\Templating;

use Twig_Environment;

use Elcodi\Component\Plugin\EventInterface;

/**
 * Renders import/export buttons in Twig
 *
 * @author Berny Cantos <be@rny.cc>
 */
class TwigRenderer
{
    /**
     * Current Twig environment
     *
     * @var Twig_Environment
     */
    protected $twig;

    /**
     * @param Twig_Environment $twig
     */
    public function __construct(Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * Renders import/export buttons
     *
     * @param EventInterface $event
     *
     * @return string
     */
    public function renderButtons(EventInterface $event)
    {
        if ($event->get('entity_type') !== 'product') {
            return;
        }

        $this->appendTemplate('@ProductCsv/buttons.html.twig', $event);
    }

    /**
     * Render a template and append to the current content
     *
     * @param string         $template
     * @param EventInterface $event
     */
    protected function appendTemplate($template, EventInterface $event)
    {
        $event->setContent(
            $event->getContent() .
            $this->twig->render($template, $event->getContext())
        );
    }
}
