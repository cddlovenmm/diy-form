<?php
namespace MillionGao\DiyForm\Repositories;

use Dcat\Admin\Repositories\EloquentRepository;
use MillionGao\DiyForm\Models\DiyFormDataCount as Model;

class DiyFormDataCount extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}