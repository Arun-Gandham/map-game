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
                <form class="card-body" method="POST"
                    action="{{ isset($game) ? route('game.edit.submit') : route('game.add.submit') }}">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-12">
                                    <label class="col-sm-3 col-form-label" for="multicol-username">Name</label>
                                    <div class="col-sm-11">
                                        <input type="text" class="form-control" placeholder="Name" name="name"
                                            value="{{ isset($game) ? $game->name : '' }}" required>
                                    </div>
                                    <div class="col-12">
                                    <form action="upload.php" method="post" enctype="multipart/form-data">
                                    <label class="col-sm-3 col-form-label" for="image">selct an image</label>
                                    <div class="col-sm-11">
                                        <input type="file" class="form-control" id="image" name="image" accept="image/*"
                                            value="{{ isset($game) ? $game->image : '' }}" required>
                                            </form>
                                    </div>
                                </div>
                               
                                
                                <div class="col-12">
                                    <label class="col-sm-3 col-form-label" for="multicol-username">Max Time</label>
                                    <div class="col-sm-11">
                                        <input type="number" class="form-control" placeholder="max_time" name="max_time"
                                            value="{{ isset($game) ? $game->max_time : '' }}" required>
                                    </div>
                                </div>

                            
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div>
                                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                <textarea class="form-control" rows="6" name="description" required>{{ isset($group) ? $group->description : '' }}</textarea>
                            </div>
                        </div>

                        <div class="pt-4">
                            <div class="row justify-content-start">
                                <div class="col-sm-9">
                                    <input type="hidden" name="id" value="{{ isset($game) ? $game->id : '' }}">
                                    <button type="submit"
                                        class="btn btn-primary me-sm-2 me-1 waves-effect waves-light">{{ isset($game) ? 'Update' : 'Submit' }}</button>
                                    <button class="btn btn-label-secondary waves-effect"><a
                                            href="{{ route('game.list') }}">Cancel</a></button>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
    
    </div>
   
    <div class="d-flex justify-content-between">
        <h4 class="py-3 mb-3">
            <span class="text-muted fw-light">Points/</span> List
        </h4>
        <a href="{{ route('group.add') }}"><button class="btn btn-primary mt-2" style="padding: 15px;height: 30px;"><i
                    class="fa-solid fa-plus"></i>
                Add</button></a>
    </div>
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table id="data-table" class="datatables-basic table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Distance</th>
                        <th>Points</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

@endsection
