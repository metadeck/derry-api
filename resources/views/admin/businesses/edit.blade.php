@extends('admin._layout.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content header -->
    @include('admin.contentheader', [
        'page_title' => 'Edit ' . $business->name,
        'page_breadcrumbs' => [
            ['title' => 'Businesses', 'icon_class' => 'fa fa-building'],
            ['title' => 'Edit', 'icon_class' => 'fa fa-pencil-square-o']
        ]
    ])
    <!-- /Content header -->

        <div class="content">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <business-edit :business="{{json_encode($business)}}" :categories="{{json_encode($categories)}}"></business-edit>
                </div>
            </div>
        </div><!-- /content -->
    </div>

@endsection
