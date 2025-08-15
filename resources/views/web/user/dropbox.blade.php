@extends('web.layout.master')
@section('content')
<section class="myaccount ptb-80 bg-lightgrey">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-xl-3 col-xxl-3 col-md-4  mb-mob-15">
                @include('web.component.profile-sidebar')
            </div>
            <div class="col-lg-8 col-xl-9 col-xxl-9 col-md-9">
                <div class="card mb-3">
                    <div class="card-header p-3">
                        <h2 class="card-title">Dropbox</h2>
                    </div>
                    <div class="card-body p-3">
                        <div class="form-group dropboxfile">
                            <label for="filedropbox">
                                <i class="fa fa-cloud-upload-alt"></i>
                                <p class="mb-0">Drag or Drop File Here</p>
                            </label>
                            <small>Maximum File Upload Size Is 10mb(10,240KB)</small>
                            <input type="file" id="filedropbox" name="filedropbox" style="display:none">
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>File Name</th>
                                        <th>Date Uploaded</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>i-130fileintro.pdf</td>
                                        <td>10/06/2022 11:18 AM</td>
                                        <td><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn-danger btnround"><i class="fa fa-trash"></i></a><a href="javascript:void(0)" class="btn-success btnround ms-1"><i class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>abdfileintro.pdf</td>
                                        <td>08/06/2022 02:13 PM</td>
                                        <td><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn-danger btnround"><i class="fa fa-trash"></i></a><a href="javascript:void(0)" class="btn-success btnround ms-1"><i class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>drop123intro.pdf</td>
                                        <td>04/06/2022 09:15 AM</td>
                                        <td><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn-danger btnround"><i class="fa fa-trash"></i></a><a href="javascript:void(0)" class="btn-success btnround ms-1"><i class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>file34gfhintro.pdf</td>
                                        <td>02/06/2022 10:30 AM</td>
                                        <td><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn-danger btnround"><i class="fa fa-trash"></i></a><a href="javascript:void(0)" class="btn-success btnround ms-1"><i class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>intro1dfdropbox.pdf</td>
                                        <td>28/05/2022 12:18 PM</td>
                                        <td><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn-danger btnround"><i class="fa fa-trash"></i></a><a href="javascript:void(0)" class="btn-success btnround ms-1"><i class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection