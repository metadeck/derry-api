@extends('admin._layout.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content header -->
        @include('admin.contentheader', [
            'page_title' => $building->name,
            'page_breadcrumbs' => [
                ['title' => 'Buildings', 'link' => route('admin.building.index'), 'icon_class' => 'fa fa-building'],
                ['title' => $building->name, 'icon_class' => 'fa fa-building'],
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
                                    <li>Name: {{ $building->name }}</li>
                                    <li>Address 1: {{ $building->address_1 or 'Not Set' }}</li>
                                    <li>Address 2: {{ $building->address_2 or 'Not Set'  }}</li>
                                    <li>City: {{ $building->city or 'Not Set'  }}</li>
                                    <li>County: {{ $building->county or 'Not Set'  }}</li>
                                    <li>Country: {{ $building->country or 'Not Set'  }}</li>
                                    <li>Postal Code: {{ $building->postal_code or 'Not Set'  }}</li>
                                    <li>Created: <span class="text-semibold">{{ $building->created_at->diffForHumans() }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Recordings</h6>
                        </div>

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <th>User</th>
                                        <th>Condition</th>
                                        <th>Date</th>
                                    </thead>
                                    <tbody>
                                        @foreach($building->recordings as $recording)
                                        <tr>
                                            <td>{{ $recording->user->fullName }}</td>
                                            <td>{{ $recording->condition->name }}</td>
                                            <td>{{ $recording->created_at->diffForHumans() }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-3">
                    <!-- User thumbnail -->
                    <div class="thumbnail">
                        <div class="thumb">
                            <map-simple-single-marker
                                    :latitude="{{ $building->latitude }}"
                                    :longitude="{{ $building->longitude }}"
                                    title="{{ $building->name }}">
                            </map-simple-single-marker>
                        </div>

                        <div class="caption text-center">
                            <h6 class="text-semibold no-margin">{{ $building->address_1 or 'No Street Address Details' }}</h6>
                        </div>
                    </div>
                    <!-- /user thumbnail -->
                </div>

        </div>

    </div>



@endsection