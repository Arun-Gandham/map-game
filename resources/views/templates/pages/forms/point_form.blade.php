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


    <script src="{{ asset('assets/vendor/libs/autosize/autosize.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/forms-extras.js') }}"></script>
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
                <form class="card-body" method="POST"
                    action="{{ isset($point) ? route('point.edit.submit') : route('point.add.submit') }}"
                    enctype="multipart/form-data">
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
                                    <label class="col-sm-3 col-form-label" for="multicol-username">Title</label>
                                    <div class="col-sm-11">
                                        <input type="text" class="form-control" placeholder="Title" name="title"
                                            value="{{ isset($point) ? $point->title : '' }}" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="col-sm-3 col-form-label" for="multicol-username">Lat & Long</label>
                                    <div class="col-sm-11">
                                        <input type="text" class="form-control" placeholder="Lat&Long" name="latitude"
                                            value="{{ isset($point) ? $point->lat_long : '' }}" required>
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
                                        <input type="file" class="form-control" name="image" accept="image/*"
                                            {{ isset($point) ? '' : 'required' }}>
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
                                    <input type="hidden" name="id" value="{{ isset($point) ? $point->id : '' }}">
                                    <input type="hidden" name="game_id"
                                        value="{{ isset($point) ? $point->game_id : '' }}">
                                    <button type="submit"
                                        class="btn btn-primary me-sm-2 me-1 waves-effect waves-light">{{ isset($point) ? 'Update' : 'Submit' }}</button>
                                    <button class="btn btn-label-secondary waves-effect"><a
                                            href="{{ route('group.list') }}">Cancel</a></button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-12">
                                    <label for="typeSelect" class="col-sm-3 col-form-label">Question</label>
                                    <div class="col-sm-11">
                                        <input type="text" class="form-control" placeholder="Question"
                                            name="question" value="{{ isset($point) ? $point->question : '' }}" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="col-md-6 col-sm-3 col-form-label" for="multicol-username">Question
                                        Description</label>
                                    <div class="col-sm-11">
                                        <input type="text" class="form-control" placeholder="Question Description"
                                            name="question_des" value="{{ isset($point) ? $point->question_des : '' }}"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="form-repeater">
                                    <div data-repeater-list="options">
                                        @if (isset($point))
                                            @foreach (unserialize($point->options) as $option)
                                                <div data-repeater-item>
                                                    <div class="row">
                                                        <label class="col-md-6 col-sm-3 col-form-label"
                                                            for="multicol-username">Option</label>
                                                        <div class="col-sm-12 row">
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control"
                                                                    placeholder="Option" name="option"
                                                                    value="{{ isset($option) ? $option : '' }}" required>

                                                            </div>
                                                            <div class="mb-3 col-lg-2 col-xl-2 col-12">
                                                                <button class="btn btn-label-danger" type="button"
                                                                    data-repeater-delete>
                                                                    <i class="ti ti-x ti-xs me-1"></i>
                                                                    <span class="align-middle">Delete</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            @endforeach
                                        @else
                                            <div data-repeater-item>
                                                <div class="row">
                                                    <label class="col-md-6 col-sm-3 col-form-label"
                                                        for="multicol-username">Option</label>
                                                    <div class="col-sm-12 row">
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control"
                                                                placeholder="Option" name="option" required>

                                                        </div>
                                                        <div class="mb-3 col-lg-2 col-xl-2 col-12">
                                                            <button class="btn btn-label-danger" type="button"
                                                                data-repeater-delete>
                                                                <i class="ti ti-x ti-xs me-1"></i>
                                                                <span class="align-middle">Delete</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        @endif
                                    </div>
                                    <div class="mb-0">
                                        <button class="btn btn-primary" type="button" data-repeater-create>
                                            <i class="ti ti-plus me-1"></i>
                                            <span class="align-middle">Add</span>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>

@endsection
