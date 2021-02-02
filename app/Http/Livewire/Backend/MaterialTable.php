<?php

namespace App\Http\Livewire\Backend;

use App\Models\Material;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

class MaterialTable extends TableComponent
{
    use HtmlComponents;

    use WithPagination;


    public $search;

    public $perPage = '10';

    public $tableFooterEnabled = true;

    public $perPageOptions = ['10', '25', '50', '100'];

    public $exports = ['csv', 'xls', 'xlsx'];
    public $exportFileName = 'feedstocks';

    public $clearSearchButton = true;
    
    protected $queryString = ['search' => ['except' => ''], 'perPage'];


    /**
     * @var string
     */
    public $sortField = 'name';

    /**
     * @var array
     */
    protected $options = [
        'bootstrap.container' => false,
        'bootstrap.classes.table' => 'table table-striped table-bordered',
        'bootstrap.responsive' => true,

    ];

    /**
     * @return Builder
     */
    public function query(): Builder
    {
		return Material::query();
    }


    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Part Number'), 'part_number')
                ->searchable()
                ->sortable(),
            Column::make(__('Name'), 'name')
                ->searchable()
                ->sortable(),
            Column::make(__('Price'), 'price')
                ->searchable()
                ->sortable(),
            Column::make(__('Stock'), 'stock')
                ->searchable()
                ->sortable(),
            Column::make(__('Unit'), 'unit_id')
                ->searchable(),
            Column::make(__('Color'), 'color_id')
                ->searchable(),
            Column::make(__('Size'), 'size_id')
                ->searchable(),
        ];
    }

}
