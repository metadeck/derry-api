@extends('admin._layout.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content header -->
    @include('admin.contentheader', [
        'page_title' => 'Edit ' . $building->name,
        'page_breadcrumbs' => [
            ['title' => 'Buildings', 'icon_class' => 'fa fa-building'],
            ['title' => 'Edit', 'icon_class' => 'fa fa-pencil-square-o']
        ]
    ])
    <!-- /Content header -->

        <div class="content">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <building-edit :building="{{json_encode($building)}}" :categories="{{json_encode($categories)}}"></building-edit>
                </div>
            </div>
        </div><!-- /content -->
    </div>

@endsection
