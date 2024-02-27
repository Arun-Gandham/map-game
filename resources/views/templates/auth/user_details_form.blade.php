@extends('layouts/layoutMaster')

@section('title', 'Validation - Forms')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/tagify/tagify.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/tagify/tagify.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/form-validation.js') }}"></script>
@endsection

@section('content')
    <div class="container">

        <div class="row">
            <!-- FormValidation -->
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h4 class="py-3 mb-4">
                    <span class="text-muted fw-light">User /</span> Form 2
                </h4>
                <div class="card">
                    <h5 class="card-header">User Detail Form</h5>
                    <div class="card-body">

                        <form id="formValidationExamples" class="row g-3" method="POST"
                            action="{{ route('user.details.submit') }}">
                            @csrf

                            <div class="col-md-6">
                                <label class="form-label" for="formValidationName">First Name</label>
                                <input type="text" id="formValidationName" name="fname" class="form-control"
                                    placeholder="First Name" name="formValidationName" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="formValidationName">Last Name</label>
                                <input type="text" id="formValidationName" name="lname" class="form-control"
                                    placeholder="Last Name" name="formValidationName" />
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="formValidationSelect2">Local Currency</label>
                                <select id="formValidationSelect2" name="local_currency" class="form-select select2"
                                    data-allow-clear="true">
                                    <option value="">Select</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Belarus">Belarus</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="Canada">Canada</option>
                                    <option value="China">China</option>
                                    <option value="France">France</option>
                                    <option value="Germany">Germany</option>
                                    <option value="India">India</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Israel">Israel</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Korea">Korea, Republic of</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Russia">Russian Federation</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="Turkey">Turkey</option>
                                    <option value="Ukraine">Ukraine</option>
                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="United States">United States</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="formValidationSelect2">Local Bank</label>
                                <select id="formValidationSelect2" name="local_bank" class="form-select select2"
                                    data-allow-clear="true">
                                    <option value="">Select</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Belarus">Belarus</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="Canada">Canada</option>
                                    <option value="China">China</option>
                                    <option value="France">France</option>
                                    <option value="Germany">Germany</option>
                                    <option value="India">India</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Israel">Israel</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Korea">Korea, Republic of</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Russia">Russian Federation</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="Turkey">Turkey</option>
                                    <option value="Ukraine">Ukraine</option>
                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="United States">United States</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="formValidationName">Local Bank Account ID/Other ID</label>
                                <input type="text" id="formValidationName" class="form-control"
                                    placeholder="John Doe" name="acct_number" />
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="formValidationSelect2">ID Type</label>
                                <select id="formValidationSelect2" name="acct_type" class="form-select select2"
                                    data-allow-clear="true">
                                    <option value="">Select</option>
                                    <option value="Australia">Bank ID</option>
                                    <option value="Bangladesh">Bank IFSC</option>
                                    <option value="Belarus">Bank Location</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="formValidationName">USDT/USDC wallet ID</label>
                                <input type="text" id="formValidationName" class="form-control"
                                    placeholder="USDT/USDC wallet ID" name="wallet_id" />
                            </div>

                            <div class="col-12">
                                <button type="submit" name="submitButton" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
            <!-- /FormValidation -->
        </div>
    </div>

@endsection
