@extends('admin._layout.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content header -->
        @include('admin.contentheader', [
            'page_title' => 'Create Business',
            'page_breadcrumbs' => [
                ['title' => 'Businesses', 'icon_class' => 'fa fa-building'],
                ['title' => 'Create', 'icon_class' => 'fa fa-plus']
            ]
        ])
        <!-- /Content header -->

        <div class="content">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <business-create :categories="{{json_encode($categories)}}"></business-create>
                </div>
            </div>
        </div><!-- /content -->
    </div>

@endsection
