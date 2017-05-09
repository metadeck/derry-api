@extends('admin._layout.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content header -->
        @include('admin.contentheader', [
            'page_title' => $app_user->fullName,
            'page_breadcrumbs' => [
                ['title' => 'App Users', 'link' => route('admin.app.user.index'), 'icon_class' => 'fa fa-users'],
                ['title' => $app_user->fullName, 'icon_class' => 'fa fa-user'],
            ]
        ])
        <!-- /Content header -->

        <div class="content">
            <!-- User profile -->
            <div class="row">
                <div class="col-lg-9 col-md-9">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Details</h6>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <ul class="list">
                                    <li>First Name: {{ $app_user->first_name }}</li>
                                    <li>Last Name: {{ $app_user->last_name }}</li>
                                    <li>Email: {{ $app_user->email }}</li>
                                    <li>Account Created: <span class="text-semibold">{{ $app_user->created_at->diffForHumans() }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Recordings</h6>
                        </div>

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <th>Building</th>
                                    <th>Condition</th>
                                    <th>Date</th>
                                    </thead>
                                    <tbody>
                                    @if($app_user->recordings->count() > 0)
                                        @foreach($app_user->recordings as $recording)
                                            <tr>
                                                <td>{{ $recording->building->name }}</td>
                                                <td>{{ $recording->condition->name }}</td>
                                                <td>{{ $recording->created_at->diffForHumans() }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4">No recordings yet :-(</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-3 col-md-3">
                    <!-- User thumbnail -->
                    <div class="thumbnail">
                        <div class="thumb thumb-rounded">
                            <img src="{{ $app_user->avatar or '/assets/images/placeholder.jpg' }}" alt="">
                        </div>

                        <div class="caption text-center">
                            <h6 class="text-semibold no-margin">{{ $app_user->fullName }}</h6>
                        </div>
                    </div>
                    <!-- /user thumbnail -->
                </div>
            </div>
        </div>

    </div>



@endsection