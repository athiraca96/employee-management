@extends('layouts.app')
@section('content')

@component('components.listing', ['title' => 'Manage Companies'])
{{ $dataTable->table(['class' => 'table table-striped table-bordered']) }}
@endcomponent

@endsection

@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush