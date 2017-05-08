@extends('admin._layout.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content header -->
        @include('admin.contentheader', [
            'page_title' => 'Statuses',
            'page_breadcrumbs' => [
                ['title' => 'Statuses', 'icon_class' => 'fa fa-building']
            ],
            'call_to_action' => ['link' => route('admin.status.create'), 'text' => 'Create Status']
        ])
        <!-- /Content header -->

        <div class="content">
            <div class="panel panel-flat">
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Num Recordings</th>
                                <th>Created</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($statuses as $status)
                                <tr>
                                    <td>{{ $status->name }}</td>
                                    <td>{{ $status->recordings()->count() }}</td>
                                    <td>{{ $status->created_at->format('d M y')}}</td>
                                    <td><a href="{{ route('admin.status.edit', [$status->id]) }}">edit</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="content-group text-center">
                        {{ $statuses->links() }}
                    </div>

                </div>
            </div>
        </div><!-- /content -->
    </div>

@endsection
