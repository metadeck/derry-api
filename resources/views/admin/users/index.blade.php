@extends('admin._layout.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content header -->
        @include('admin.contentheader', [
            'page_title' => 'Users',
            'page_breadcrumbs' => [
                ['title' => 'App Users', 'icon_class' => 'fa fa-users']
            ]
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
                                <th>Email</th>
                                <th>Account Created</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td><a href="{{ route('admin.app.user.show', [$app_user->id]) }}">{{ $user->fullName }}</a></td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at->format('d M y')}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="content-group text-center">
                        {{ $users->links() }}
                    </div>

                </div>
            </div>
        </div><!-- /content -->
    </div>

@endsection
