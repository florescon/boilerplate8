<div class="card">

  @include('backend.color.update')
  @include('backend.color.create')
  @include('backend.color.show')

<div class="card-header">
  <strong style="color: #0061f2;"> @lang('List of colors') </strong>
  <div class="card-header-actions">
     <em> Última petición: {{ now()->format('h:i:s') }} </em>
    <a href="#" class="card-header-action" data-toggle="modal" wire:click="createmodal()" data-target="#exampleModal"><i class="c-icon cil-plus"></i> @lang('Create color') </a>
  </div>

    <br>
    <br>

    &nbsp;
    <div class="page-header-subtitle">@lang('Filter by update date range')</div>

    <div class="row input-daterange">
        <div class="col-md-3">
            <input type="date" wire:model="dateInput" class="form-control" placeholder="@lang('From')" />
        </div>
        &nbsp;

        <div class="col-md-3">
            <input type="date"  wire:model="dateOutput" class=" form-control" placeholder="@lang('To')" />
        </div>
        &nbsp;

        <div class="col-md-3">
          <div class="btn-group mr-2" role="group" aria-label="First group">
            <button type="button" class="btn btn-outline-primary" wire:click="clearFilterDate"  class="btn btn-default">@lang('Clear date')</button>
            <button type="button" class="btn btn-primary" wire:click="clearAll" class="btn btn-default">@lang('Clear all')</button>
          </div>
        </div>
        &nbsp;

        <div class="col-md-1">
          <div class="custom-control custom-switch">
            <input type="checkbox" wire:model="deleted" class="custom-control-input" id="deletedSwitch">
            <label class="custom-control-label" for="deletedSwitch"> <p  class="{{ $deleted ? 'text-primary' : 'text-dark' }}"> @lang('Deletions')</p></label>
          </div>
        </div>

    </div>
</div>


<div class="card-body">

@include('includes.partials.messages-livewire')
<div wire:offline.class="d-block" wire:offline.class.remove="d-none" class="alert alert-danger d-none">
    @lang('You are not currently connected to the internet.')    
</div>

  <div class="row mb-4">
    <div class="col form-inline">
      @lang('Per page'): &nbsp;

      <select wire:model="perPage" class="form-control">
        <option>10</option>
        <option>25</option>
        <option>50</option>
        <option>100</option>
      </select>
    </div><!--col-->

    <div class="col">
      <div class="input-group">
        <input wire:model.debounce.350ms="searchTerm" class="form-control" type="text" placeholder="{{ __('Search') }}..." />
        @if($searchTerm !== '')
        <div class="input-group-append">
          <button type="button" wire:click="clear" class="close" aria-label="Close">
            <span aria-hidden="true"> &nbsp; &times; &nbsp;</span>
          </button>

        </div>
        @endif
      </div>
    </div>

    <div class="dropdown table-export">
      <button class="dropdown-toggle btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        @lang('Export')        
      </button>

      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="#" wire:click.prevent="export">CSV</a>

        <a class="dropdown-item" href="#" wire:click.prevent="export('xls')">XLS</a>

        <a class="dropdown-item" href="#" wire:click.prevent="export('xlsx')">XLSX</a>

        <a class="dropdown-item" href="#" wire:click.prevent="export('pdf')">PDF</a>
      </div>
    </div><!--export-dropdown-->
  </div><!--row-->



  <div class="row mt-4">
    <div class="col">
      <div class="table-responsive">
        <table class="table table-sm align-items-center table-flush table-bordered table-hover">
          <thead style="color: #0061f2;">
            <tr>
              <th scope="col"><a wire:click.prevent="sortBy('name')" role="button" href="#">
                @lang('Name')
                @include('backend.includes._sort-icon', ['field' => 'name'])
              </a></th>
              <th scope="col">@lang('Color')</th>
              <th scope="col"><a wire:click.prevent="sortBy('updated_at')" role="button" href="#">
                @lang('Updated at')
                @include('backend.includes._sort-icon', ['field' => 'updated_at'])
              </a>
              </th>
              <th scope="col" style="width:90px; max-width: 90px;">@lang('Actions')</th>
            </tr>
          </thead>
          <tbody>
            @foreach($colors as $color)
            <tr>
              <th scope="row">
                <div class="media align-items-center">
                  <div class="media-body">
                    <span class="mb-0 text-sm">{{ $color->name }}</span>
                  </div>
                </div>
              </th>
              <td>
                {{ $color->color }}
              </td>
              <td>
                <span class="badge badge-dot mr-4">
                  <i class="bg-warning"></i> {{ $color->updated_at }}
                </span>
              </td>
              <td>
                <div class="btn-group" role="group" aria-label="Basic example">


                    <button type="button" data-toggle="modal" data-target="#showModal" wire:click="show({{ $color->id }})" class="btn btn-transparent-dark">
                        <i class='far fa-eye'></i>
                    </button>

                  @if(!$color->trashed())

                    <button type="button" data-toggle="modal" data-target="#updateModal" wire:click="edit({{ $color->id }})" class="btn btn-transparent-dark">
                      <i class='far fa-edit'></i>
                    </button>

                    <div class="dropdown">
                      <a class="btn btn-icon-only " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" wire:click="delete({{ $color->id }})">@lang('Delete')</a>
                      </div>
                    </div>

                  @else
                    <div class="dropdown">
                      <a class="btn btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <a class="dropdown-item" href="#" wire:click="restore({{ $color->id }})">
                          @lang('Restore')
                        </a>
                      </div>
                    </div>
                  @endif

                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

        @if($colors->count())
        <div class="row">
          <div class="col">
            <nav>
              {{ $colors->links() }}
            </nav>
          </div>
              <div class="col-sm-3 text-muted text-right">
                Mostrando {{ $colors->firstItem() }} - {{ $colors->lastItem() }} de {{ $colors->total() }} resultados
              </div>
        </div>
        @else
          @lang('No search results') 
          @if($searchTerm)
            "{{ $searchTerm }}" 
          @endif

          @if($deleted)
            @lang('for deleted')
          @endif

          @if($dateInput) 
            @lang('from') {{ $dateInput }} {{ $dateOutput ? __('To') .' '.$dateOutput : __('to this day') }}
          @endif

          @if($page > 1)
            {{ __('in the page').' '.$page }}
          @endif
        @endif

      </div>

    </div>
  </div>
</div>
</div>

