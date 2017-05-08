@extends('admin._layout.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content header -->
        @include('admin.contentheader', [
            'page_title' => 'Create Building',
            'page_breadcrumbs' => [
                ['title' => 'Buildings', 'icon_class' => 'fa fa-building'],
                ['title' => 'Create', 'icon_class' => 'fa fa-plus']
            ]
        ])
        <!-- /Content header -->

        <div class="content">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <recording-create
                            :statuses="{{json_encode($statuses)}}"
                            :conditions="{{json_encode($conditions)}}">

                    </recording-create>
                </div>
            </div>
        </div><!-- /content -->
    </div>

@endsection
