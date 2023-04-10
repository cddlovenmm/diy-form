<?php
namespace MillionGao\DiyForm\Repositories;

use Dcat\Admin\Repositories\EloquentRepository;
use MillionGao\DiyForm\Models\DiyForm as Model;

class DiyForm extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}