@extends('layouts.master')

@section('content')
    <div class="block-header">
        <h2>ARTISTS</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        </div>
    </div>

    <!-- Input -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Add New Artists
                        <small>Enter Artist Data</small>
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another action</a></li>
                                <li><a href="javascript:void(0);">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <h2 class="card-inside-title">Basic Examples</h2>
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Username" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" class="form-control" placeholder="Password" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <h2 class="card-inside-title">Different Widths</h2>
                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="col-sm-6" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="col-sm-6" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="col-sm-4" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="col-sm-4" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="col-sm-4" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="col-sm-3" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="col-sm-3" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="col-sm-3" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="col-sm-3" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <h2 class="card-inside-title">Different Sizes</h2>
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group form-group-lg">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Large Input" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Default Input" />
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Small Input" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <h2 class="card-inside-title">Floating Label Examples</h2>
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control">
                                    <label class="form-label">Username</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="password" class="form-control">
                                    <label class="form-label">Password</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-float form-group-lg">
                                <div class="form-line">
                                    <input type="text" class="form-control" />
                                    <label class="form-label">Large Input</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" />
                                    <label class="form-label">Default Input</label>
                                </div>
                            </div>
                            <div class="form-group form-float form-group-sm">
                                <div class="form-line">
                                    <input type="text" class="form-control" />
                                    <label class="form-label">Small Input</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h2 class="card-inside-title">Input Status</h2>
                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line focused">
                                    <input type="text" class="form-control" value="Focused" placeholder="Statu Focused" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line disabled">
                                    <input type="text" class="form-control" placeholder="Disabled" disabled />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Input -->

@endsection
