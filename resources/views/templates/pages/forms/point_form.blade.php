@extends('layouts/layoutMaster')

@section('title', 'DataTables - Tables')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <!-- Row Group CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}">
    <!-- Form Validation -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <!-- Flat Picker -->
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <!-- Form Validation -->
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
@endsection

@section('page-script')
    {{-- <script src="{{ asset('assets/js/tables-datatables-basic.js') }}"></script> --}}
@endsection

@section('content')
    @if ($error = session('error'))
        <div class="alert alert-danger d-flex align-items-center alert-dismissible" role="alert">
            {{ $error }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif
    @if ($success = session('success'))
        <div class="alert alert-success d-flex align-items-center alert-dismissible" role="alert">
            {{ $success }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif


    <div class="row">
        <!-- Form Separator -->
        <div class="col">
            <div class="card mb-4">
                <form class="card-body" method="POST" action="{{ route('point.add.submit') }}">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-12">
                                    <label for="typeSelect" class="col-sm-3 col-form-label">Choose Type</label>
                                    <div class="col-sm-11">
                                        <select class="form-select" id="typeSelect" name="type">
                                            @foreach ($types as $type)
                                                <option value="{{ $type->id }}"
                                                    {{ isset($point) && $point->type == $type->id ? 'selected' : '' }}>
                                                    {{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="col-sm-3 col-form-label" for="multicol-username">Lat & Long</label>
                                    <div class="col-sm-11">
                                        <input type="text" class="form-control" placeholder="Lat&Long" name="latitude"
                                            value="{{ isset($point) ? $point->lat & long : '' }}" required>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <label class="col-sm-3 col-form-label" for="multicol-username">Distance (meters)</label>
                                    <div class="col-sm-11">
                                        <input type="number" class="form-control" placeholder="Distance" name="distance"
                                            value="{{ isset($point) ? $point->distance : '' }}" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="col-sm-3 col-form-label" for="multicol-username">Upload Image</label>
                                    <div class="col-sm-11">
                                        <input type="file" class="form-control" name="image" accept="image/*" required>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="col-md-6">
                            <div>
                                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                <textarea class="form-control" rows="6" name="description" required>{{ isset($point) ? $point->description : '' }}</textarea>
                            </div>
                        </div>

                        <div class="pt-4">
                            <div class="row justify-content-start">
                                <div class="col-sm-9">
                                    <input type="hidden" name="id" value="{{ isset($point) ? $game->id : '' }}">
                                    <input type="hidden" name="game_id" value="{{ isset($id) ? $id : '' }}">
                                    <button type="submit"
                                        class="btn btn-primary me-sm-2 me-1 waves-effect waves-light">{{ isset($point) ? 'Update' : 'Submit' }}</button>
                                    <button class="btn btn-label-secondary waves-effect"><a
                                            href="{{ route('group.list') }}">Cancel</a></button>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>

@endsection+
