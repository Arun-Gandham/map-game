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
                <div class="row mb-3 p-4">
                    <ul class="list-unstyled mb-4 mt-3">
                        <li class="d-flex align-items-center mb-3"><i class="ti ti-user text-heading"></i><span
                                class="fw-medium mx-2 text-heading">Game Name:</span> <span>{{ $game->name }}</span></li>
                        <li class="d-flex align-items-center mb-3"><i class="ti ti-check text-heading"></i><span
                                class="fw-medium mx-2 text-heading">Max Time:</span> <span>{{ $game->max_time }}</span>
                        </li>
                        <li class="d-flex align-items-center mb-3"><i class="ti ti-file-description text-heading"></i><span
                                class="fw-medium mx-2 text-heading">Description:</span>
                            <span>{{ $game->description }}</span>
                        </li>
                    </ul>
                    <div class="pt-1">
                        <div class="row justify-content-start">
                            <div class="col-sm-9">
                                <a href="{{ route('game.edit', $game->id) }}" class="text-white"><button type="submit"
                                        class="btn btn-primary me-sm-2 me-1 waves-effect waves-light">Edit</button></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- DataTable with Buttons -->
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

        <!--/ DataTable with Buttons -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('point.list.datatbles', $game->id) }}',
                    columns: [{
                            data: 'title'
                        },
                        {
                            data: 'type_name'
                        },
                        {
                            data: 'distance'
                        },
                        {
                            data: 'points'
                        }
                    ]
                });
            });
        </script>
    @endsection
