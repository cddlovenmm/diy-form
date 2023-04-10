<?php
namespace MillionGao\DiyForm\Repositories;

use Dcat\Admin\Repositories\EloquentRepository;
use MillionGao\DiyForm\Models\DiyFormData as Model;

class DiyFormData extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}