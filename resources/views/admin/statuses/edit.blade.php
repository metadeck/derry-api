@extends('admin._layout.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content header -->
    @include('admin.contentheader', [
        'page_title' => 'Edit ' . $status->name,
        'page_breadcrumbs' => [
            ['title' => 'Statuses', 'icon_class' => 'fa fa-building'],
            ['title' => 'Edit', 'icon_class' => 'fa fa-pencil-square-o']
        ]
    ])
    <!-- /Content header -->

        <div class="content">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <status-edit :status="{{json_encode($status)}}"></status-edit>
                </div>
            </div>
        </div><!-- /content -->
    </div>

@endsection
