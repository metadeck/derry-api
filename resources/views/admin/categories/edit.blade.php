@extends('admin._layout.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content header -->
    @include('admin.contentheader', [
        'page_title' => 'Edit ' . $category->name,
        'page_breadcrumbs' => [
            ['title' => 'Categories', 'icon_class' => 'fa fa-list'],
            ['title' => 'Edit', 'icon_class' => 'fa fa-pencil-square-o']
        ]
    ])
    <!-- /Content header -->

        <div class="content">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <category-edit :category="{{json_encode($category)}}"></category-edit>
                </div>
            </div>
        </div><!-- /content -->
    </div>

@endsection
