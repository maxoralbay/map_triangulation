<?php

namespace Services;

use Models\Triangulation;

class TriangulateService
{
    public function __construct(Triangulation $model)
    {
        $this->model = $model;
    }

    public function calculate($a, $b, $c)
    {
        $this->model->setA($a);
        $this->model->setB($b);
        $this->model->setC($c);
        $this->model->calculateArea();
        return $this->model->getArea();
    }
}
