<?php
namespace MillionGao\DiyForm\Repositories;

use MillionGao\DiyForm\Models\DiyFormRedirectUri as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class DiyFormRedirectUri  extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}