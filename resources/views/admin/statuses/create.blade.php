@extends('admin._layout.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content header -->
        @include('admin.contentheader', [
            'page_title' => 'Create Status',
            'page_breadcrumbs' => [
                ['title' => 'Statuses', 'icon_class' => 'fa fa-list'],
                ['title' => 'Create', 'icon_class' => 'fa fa-plus']
            ]
        ])
        <!-- /Content header -->

        <div class="content">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <status-create></status-create>
                </div>
            </div>
        </div><!-- /content -->
    </div>

@endsection
