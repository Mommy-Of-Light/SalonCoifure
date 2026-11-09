<?php

namespace BastienJcln\SalonCoifure\Controllers;

use Slim\Views\PhpRenderer;

abstract class BaseController
{
    /**
     * @var PhpRenderer
     */
    protected PhpRenderer $view;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->view = new PhpRenderer(__DIR__ . '/../../views', [
            'title' => 'CFPT COIFFURE',
            'withMenu' => true,
        ]);

        $this->view->setLayout("layout.php");
    }
}
