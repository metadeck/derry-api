@extends('admin._layout.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content header -->
        @include('admin.contentheader', [
            'page_title' => $business->name,
            'page_breadcrumbs' => [
                ['title' => 'Business', 'link' => route('admin.business.index'), 'icon_class' => 'fa fa-building'],
                ['title' => $business->name, 'icon_class' => 'fa fa-business'],
            ]
        ])
        <!-- /Content header -->

        <div class="content">
            <!-- User profile -->
                <div class="col-lg-9">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Details</h6>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <ul class="list">
                                    <li>Name: {{ $business->name }}</li>
                                    <li>Address 1: {{ $business->address_1 or 'Not Set' }}</li>
                                    <li>Address 2: {{ $business->address_2 or 'Not Set'  }}</li>
                                    <li>City: {{ $business->city or 'Not Set'  }}</li>
                                    <li>County: {{ $business->county or 'Not Set'  }}</li>
                                    <li>Country: {{ $business->country or 'Not Set'  }}</li>
                                    <li>Postal Code: {{ $business->postal_code or 'Not Set'  }}</li>
                                    <li>Created: <span class="text-semibold">{{ $business->created_at->diffForHumans() }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-3">
                    <!-- User thumbnail -->
                    <div class="thumbnail">
                        <div class="thumb">
                            <map-simple-single-marker
                                    :latitude="{{ $business->latitude }}"
                                    :longitude="{{ $business->longitude }}"
                                    title="{{ $business->name }}">
                            </map-simple-single-marker>
                        </div>

                        <div class="caption text-center">
                            <h6 class="text-semibold no-margin">{{ $business->address_1 or 'No Street Address Details' }}</h6>
                        </div>
                    </div>
                    <!-- /user thumbnail -->
                </div>

        </div>

    </div>



@endsection