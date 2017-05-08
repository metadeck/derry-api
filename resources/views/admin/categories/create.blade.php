@extends('admin._layout.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content header -->
        @include('admin.contentheader', [
            'page_title' => 'Create Category',
            'page_breadcrumbs' => [
                ['title' => 'Categories', 'icon_class' => 'fa fa-list'],
                ['title' => 'Create', 'icon_class' => 'fa fa-plus']
            ]
        ])
        <!-- /Content header -->

        <div class="content">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <category-create></category-create>
                </div>
            </div>
        </div><!-- /content -->
    </div>

@endsection
