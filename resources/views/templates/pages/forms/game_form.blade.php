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
                <form method="POST" class="mb-5"
                    action="{{ isset($game) ? route('game.edit.submit') : route('game.add.submit') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3 p-4">
                        <div class="col-md-6">
                            <div class="col-12">
                                <label class="col-sm-3 col-form-label" for="multicol-username">Name</label>
                                <div class="col-sm-11">
                                    <input type="text" class="form-control" placeholder="Name" name="name"
                                        value="{{ isset($game) ? $game->name : '' }}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="col-sm-6 col-form-label" for="multicol-username">Max Time (in seconds)</label>
                                <div class="col-sm-11">
                                    <input type="number" class="form-control" placeholder="Max Time (in seconds)"
                                        name="max_time" value="{{ isset($game) ? $game->max_time : '' }}" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="col-sm-3 col-form-label" for="multicol-username">Browse Image</label>
                                <div class="col-sm-11">
                                    <input type="file" class="form-control" name="image" accept="image/*">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div>
                                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                <textarea class="form-control" rows="8" name="description" required>{{ isset($game) ? $game->description : '' }}</textarea>
                            </div>
                        </div>

                        <div class="pt-4 col-md-12 ">
                            <div class="d-flex justify-content-end">
                                <div class="">
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
    <!-- DataTable with Buttons -->
    <div class="card">

        <div class="card-datatable table-responsive pt-0">
            <div class="m-3 d-flex justify-content-between">
                <h3>Points</h3>
                <button type="submit" class="btn btn-primary me-sm-2 me-1 waves-effect waves-light">Add</button>
            </div>

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

    <!--/ DataTable with Buttons -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('game.list.datatbles') }}',
                columns: [{
                        data: 'name'
                    },
                    {
                        data: 'max_time'
                    },
                    {
                        data: 'scores'
                    },
                    {
                        data: 'link'
                    }
                ]
            });
        });
    </script>
@endsection
