@extends('admin._layout.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content header -->
        @include('admin.contentheader', [
            'page_title' => 'Categories',
            'page_breadcrumbs' => [
                ['title' => 'Categories', 'icon_class' => 'fa fa-list']
            ],
            'call_to_action' => ['link' => route('admin.category.create'), 'text' => 'Create Category']
        ])
        <!-- /Content header -->

        <div class="content">
            <div class="panel panel-flat">
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Number of Businesses</th>
                                <th>Created</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td><a href="{{ route('admin.category.show', [$category->id]) }}">{{ $category->name }}</a></td>
                                    <td>{{ $category->businesses()->count() }}</td>
                                    <td>{{ $category->created_at->format('d M y')}}</td>
                                    <td><a href="{{ route('admin.category.edit', [$category->id]) }}">edit</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="content-group text-center">
                        {{ $categories->links() }}
                    </div>

                </div>
            </div>
        </div><!-- /content -->
    </div>

@endsection
