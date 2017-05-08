@extends('admin._layout.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content header -->
        @include('admin.contentheader', [
            'page_title' => 'Conditions',
            'page_breadcrumbs' => [
                ['title' => 'Conditions', 'icon_class' => 'fa fa-building']
            ],
            'call_to_action' => ['link' => route('admin.condition.create'), 'text' => 'Create Condition']
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
                            @foreach ($conditions as $condition)
                                <tr>
                                    <td>{{ $condition->name }}</td>
                                    <td>{{ $condition->recordings()->count() }}</td>
                                    <td>{{ $condition->created_at->format('d M y')}}</td>
                                    <td><a href="{{ route('admin.condition.edit', [$condition->id]) }}">edit</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="content-group text-center">
                        {{ $conditions->links() }}
                    </div>

                </div>
            </div>
        </div><!-- /content -->
    </div>

@endsection
