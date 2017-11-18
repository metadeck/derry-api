@extends('admin._layout.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content header -->
        @include('admin.contentheader', [
            'page_title' => $user->fullName,
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
                                    <li>First Name: {{ $user->first_name }}</li>
                                    <li>Last Name: {{ $user->last_name }}</li>
                                    <li>Email: {{ $user->email }}</li>
                                    <li>Account Created: <span class="text-semibold">{{ $user->created_at->diffForHumans() }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-3 col-md-3">
                    <!-- User thumbnail -->
                    <div class="thumbnail">
                        <div class="thumb thumb-rounded">
                            <img src="{{ $user->avatar or '/assets/images/placeholder.jpg' }}" alt="">
                        </div>

                        <div class="caption text-center">
                            <h6 class="text-semibold no-margin">{{ $user->fullName }}</h6>
                        </div>
                    </div>
                    <!-- /user thumbnail -->
                </div>
            </div>
        </div>

    </div>



@endsection