@extends('layouts.master')

@section('styles')
    <!-- JQuery DataTable Css -->
    <link href="/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
@endsection

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

            <div class="card">
                <div class="body">
                    <a href="{{ route('songs.create') }}" class="btn bg-deep-orange waves-effect btn-lg">
                        <i class="material-icons">add</i> Add New Song
                    </a>
                </div>

            </div>


        </div>

    </div>


    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        EXPORTABLE TABLE
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
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Song File</th>
                                <th>Remote File</th>
                                <th>Released At</th>
                                <th>Singers</th>
                                <th>Music Directors</th>
                                <th>Song Writers</th>
                                <th>Producers</th>
{{--                                <th>Status</th>--}}
                                <th>Added By</th>
                                <th>Approved By</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Song File</th>
                                <th>Remote File</th>
                                <th>Released At</th>
                                <th>Singers</th>
                                <th>Music Directors</th>
                                <th>Song Writers</th>
                                <th>Producers</th>
{{--                                <th>Status</th>--}}
                                <th>Added By</th>
                                <th>Approved By</th>
                                <th>Actions</th>
                            </tr>
                            </tfoot>
                            <tbody>

                            @foreach($songs as $song)
                                <tr>

                                    <td>{{ $song->id }}</td>
                                    <td>{{ $song->title }}</td>
                                    <td>
                                        <audio controls>
                                            <source src="{{ $song->file_path }}" type="audio/mpeg">
                                            Your browser does not support the audio tag.
                                        </audio>

                                    </td>
                                    <td>{{ $song->remote_file_path }}</td>
                                    <td>{{ $song->released_at }}</td>

                                    <td>
                                        <ul>
                                            @foreach($song->singers() as $singer)
                                                <li>
                                                    <a href="{{ route('users.show', $singer->user->id) }}">
                                                        {{ $singer->user->first_name }} {{ $singer->user->last_name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>

                                    <td>
                                        <ul>
                                            @foreach($song->musicians() as $musician)
                                                <li>
                                                    <a href="{{ route('users.show', $musician->user->id) }}">
                                                        {{ $musician->user->first_name }} {{ $musician->user->last_name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>

                                    <td>
                                        <ul>
                                            @foreach($song->writers() as $writer)
                                                <li>
                                                    <a href="{{ route('users.show', $writer->user->id) }}">
                                                        {{ $writer->user->first_name }} {{ $writer->user->last_name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>

                                    <td>
                                        <ul>
                                            @foreach($song->producers() as $producer)
                                                <li>
                                                    <a href="{{ route('users.show', $writer->user->id) }}">
                                                        {{ $producer->user->first_name }} {{ $producer->user->last_name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>


{{--                                    <td>{{ $song->getStatus() }}</td>--}}
                                    <td>
                                        <a href="{{ route('users.show', $song->addedUser->id) }}">
                                            {{ $song->addedUser->first_name }} {{ $song->addedUser->last_name }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('users.show', $song->approvedUser->id) }}">
                                            {{ $song->approvedUser->first_name }} {{ $song->approvedUser->last_name }}
                                        </a>
                                    </td>

                                    <td>
                                            <span>
                                                <a href="{{ route('songs.edit', $song->id) }}" class="btn btn-warning btn-circle waves-effect waves-circle waves-float" title="Edit">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <a href="{{ route('songs.destroy', $song->id) }}" class="btn btn-danger btn-circle waves-effect waves-circle waves-float" title="Delete">
                                                <i class="material-icons">delete</i>
                                            </a>
                                            </span>

                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Exportable Table -->




@endsection


@section('scripts')
    <!-- Jquery DataTable Plugin Js -->
    <script src="/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
{{--    <script src="/js/admin.js"></script>--}}
    <script src="/js/pages/tables/jquery-datatable.js"></script>

@endsection
