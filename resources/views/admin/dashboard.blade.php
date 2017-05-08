@extends('admin._layout.app')

@section('content')

    <div class="content-wrapper">

        <!-- Content header -->
        @include('admin.contentheader', [
            'page_title' => 'Dashboard',
            'page_breadcrumbs' => [
                ['title' => 'Dashboard', 'link' => null, 'icon_class' => 'fa fa-dashboard']
            ],
            'heading_elements' => [
                ['text' => $user_count . ' Users', 'icon' => 'icon-users', 'link' => route('admin.app.user.index')],
                ['text' => $buildings->count() . ' Buildings', 'icon' => 'icon-office', 'link' => route('admin.building.index')],
                ['text' => $recording_count . ' Recordings', 'icon' => 'icon-iphone', 'link' => route('admin.recording.index')],
            ],
        ])
        <!-- /Content header -->

        <div class="content">

            <div class="col-md-6">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Latest App Users</h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="close"></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">
                        <ul class="media-list">
                            @foreach($app_users as $app_user)
                                <li class="media">
                                    <div class="media-left media-middle">
                                        <a href="#">
                                            <img src="{{ $app_user->avatar or '/assets/images/placeholder.jpg' }}" class="img-circle" alt="">
                                        </a>
                                    </div>

                                    <div class="media-body">
                                        <div class="media-heading text-semibold">{{ $app_user->fullName }}</div>
                                    </div>

                                    <div class="media-right media-middle">
                                        {{--<ul class="icons-list icons-list-extended text-nowrap">--}}
                                        {{--<li><a href="#" data-popup="tooltip" title="Call" data-toggle="modal" data-target="#call"><i class="icon-phone2"></i></a></li>--}}
                                        {{--<li><a href="#" data-popup="tooltip" title="Chat" data-toggle="modal" data-target="#chat"><i class="icon-comment"></i></a></li>--}}
                                        {{--<li><a href="#" data-popup="tooltip" title="Video" data-toggle="modal" data-target="#video"><i class="icon-video-camera"></i></a></li>--}}
                                        {{--</ul>--}}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Latest Recordings</h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="close"></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">
                        <ul class="media-list">
                            @foreach($recordings as $recording)
                                <li class="media">
                                    <div class="media-left media-middle">

                                    </div>
                                    <div class="media-body">
                                        <div class="media-heading text-semibold">{{ $recording->building->name }}, {{ $recording->building->address_1 }}</div>
                                        <span class="text-muted">Status: {{ $recording->status->name }}</span>
                                        <span class="text-muted">Condition: {{ $recording->condition->name }}</span>
                                        <span class="media-annotation dotted">{{ $recording->created_at->diffForHumans() }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!--chart-->
            <div class="col-md-12">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Recordings</h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="close"></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">

                        <p class="content-group">Recordings over 14 days.</p>

                        <div class="chart-container">
                            <d3-bars-basic-tooltip-chart
                                    data-url="/admin/recordings/previousdays?num_days=14"
                                    :height-val="400">
                            </d3-bars-basic-tooltip-chart>
                        </div>
                    </div>
                </div>
            </div>
            <!--END chart-->

            <!--Building map view-->
            <div class="col-md-12">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Buildings</h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="close"></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">
                        <map-cluster :locations="{{ json_encode($buildings) }}">
                        </map-cluster>
                    </div>
                </div>
            </div>
            <!--END Building map view-->

        </div>

    </div>
@endsection
