@extends('admin._layout.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content header -->
        @include('admin.contentheader', [
            'page_title' => 'App Users',
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
                            @foreach ($app_users as $app_user)
                                <tr>
                                    <td><a href="{{ route('admin.app.user.show', [$app_user->id]) }}">{{ $app_user->fullName }}</a></td>
                                    <td>{{ $app_user->email }}</td>
                                    <td>{{ $app_user->created_at->format('d M y')}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="content-group text-center">
                        {{ $app_users->links() }}
                    </div>

                </div>
            </div>
        </div><!-- /content -->
    </div>

@endsection
