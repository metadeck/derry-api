@extends('admin._layout.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content header -->
        @include('admin.contentheader', [
            'page_title' => 'Businesses',
            'page_breadcrumbs' => [
                ['title' => 'Businesses', 'icon_class' => 'fa fa-building']
            ],
            'call_to_action' => ['link' => route('admin.business.create'), 'text' => 'Create business']
        ])
        <!-- /Content header -->

        <div class="content">

            {{--  <div class="panel panel-flat">
                <div class="panel-body">
                    <form class="form-horizontal" method="post" action="{{route('admin.business.search')}}">
                        {!! csrf_field() !!}
                        <div class="container-fluid">
                            <div class="col-md-2">
                                <label for="search">Search By Name</label>
                                <input type="text" id="search" name="search" class="form-control" placeholder="Search">
                            </div>
                            <div class="col-md-3">
                                <label for="categories">Categories</label>
                                <bootstrap-multiselect :id="categories" :options="{{json_encode($categories)}}"></bootstrap-multiselect>
                            </div>
                            <div class="col-md-1">
                                <label for="statuses">&nbsp;</label>
                                <input type="submit" class="btn btn-primary" value="Filter"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>  --}}

            <div class="panel panel-flat">
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Street Address</th>
                                <th>City</th>
                                <th>County</th>
                                <th>Created</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($businesses as $business)
                                <tr>
                                    <td><a href="{{ route('admin.business.show', [$business->id]) }}">{{ $business->name }}</a></td>
                                    <td>{{ $business->address_1 }}</td>
                                    <td>{{ $business->town_city }}</td>
                                    <td>{{ $business->county }}</td>
                                    <td>{{ $business->created_at->format('d M y')}}</td>
                                    <td><a href="{{ route('admin.business.edit', [$business->id]) }}">edit</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="content-group text-center">
                        {{ $businesses->links() }}
                    </div>

                </div>
            </div>
        </div><!-- /content -->
    </div>

@endsection
