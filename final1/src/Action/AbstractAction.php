<?php

namespace App\Action;

use App\Component\ActionInterface;
use App\Repository;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class AbstractAction implements ActionInterface //объявлет переменные чтобы в каждом экшене не объявлять
{
    protected Environment $twig;
    protected Repository $repository;//будут видны только ему и его наследникам

    public function __construct()
    {
        $loader = new FilesystemLoader('../templates');
        $this->twig = new Environment($loader);
        $this->repository = new Repository();
    }
}
