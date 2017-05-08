@extends('admin._layout.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content header -->
        @include('admin.contentheader', [
            'page_title' => 'Recordings',
            'page_breadcrumbs' => [
                ['title' => 'Recordings', 'icon_class' => 'fa fa-building']
            ]
        ])
        <!-- /Content header -->
        {{--{{dd(request()->conditions)}}--}}

        <div class="content">

            <div class="panel panel-flat">
                <div class="panel-body">
                    <recording-search-bar
                        :conditions="{{json_encode($conditions)}}"
                        :statuses="{{json_encode($statuses)}}"
                        :selected-condition-ids="{{ explode(',', request()->conditions) or null }}"
                        :selected-status-ids="{{ explode(',', request()->statuses) or null }}">
                    </recording-search-bar>
                </div>
            </div>

            <div class="panel panel-flat">
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>User</th>
                                <th>Building Name</th>
                                <th>Condition</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>ID</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($recordings as $recording)
                                <tr>
                                    <td><a href="{{ route('admin.app.user.show', [$recording->user->id]) }}">{{ $recording->user->fullName }}</a></td>
                                    <td><a href="{{ route('admin.building.show', [$recording->building_id]) }}">{{ $recording->building->name }}</a></td>
                                    <td>{{ $recording->status->name or 'Not Set' }}</td>
                                    <td>{{ $recording->condition->name or 'Not Set' }}</td>
                                    <td>{{ $recording->created_at->format('d M y')}}</td>
                                    <td>{{$recording->id}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="content-group text-center">
                        {{ $recordings->appends(Input::except('page'))->links() }}
                    </div>

                </div>
            </div>
        </div><!-- /content -->
    </div>

@endsection
