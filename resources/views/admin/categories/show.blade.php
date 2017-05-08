@extends('admin._layout.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content header -->
        @include('admin.contentheader', [
            'page_title' => $category->name,
            'page_breadcrumbs' => [
                ['title' => 'Categories', 'link' => route('admin.building.index'), 'icon_class' => 'fa fa-list'],
                ['title' => $category->name, 'icon_class' => 'fa fa-list'],
            ]
        ])
        <!-- /Content header -->

        <div class="content">
            <!-- User profile -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Details</h6>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <ul class="list">
                                    <li>Name: {{ $category->name }}</li>
                                    <li>Building Count: {{ $category->buildings()->count() }}</li>
                                    <li>Created: <span class="text-semibold">{{ $category->created_at->diffForHumans() }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



@endsection