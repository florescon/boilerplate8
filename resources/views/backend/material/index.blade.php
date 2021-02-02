@extends('backend.layouts.app')

@section('title', __('Feedstock'))

@section('content')


    {{-- <input
        x-data
        x-ref="input"
        x-init="new Pikaday({ field: $refs.input })"
        type="text"
    > --}}

    <x-backend.card>
        <x-slot name="header">
            @lang('Feedstock')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link
                icon="c-icon cil-plus"
                class="card-header-action"
                :href="route('admin.material.index')"
                :text="__('Create feedstock')"
            />
        </x-slot>


        <x-slot name="body">
            <livewire:backend.material-table />
        </x-slot>
    </x-backend.card>

@endsection

@section('after-scripts')

<script>
    var picker = new Pikaday({ field: document.getElementById('datepicker') });
</script>

@endsection