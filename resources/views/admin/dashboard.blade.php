@extends('admin._layout.app')

@section('content')

    <div class="content-wrapper">

        <!-- Content header -->
        @include('admin.contentheader', [
            'page_title' => 'Dashboard',
            'page_breadcrumbs' => [
                ['title' => 'Dashboard', 'link' => null, 'icon_class' => 'fa fa-dashboard']
            ],
            'heading_elements' => [
                ['text' => $user_count . ' Users', 'icon' => 'icon-users', 'link' => route('admin.user.index')],
                ['text' => $businesses->count() . ' Businesses', 'icon' => 'icon-office', 'link' => route('admin.business.index')],
            ],
        ])
        <!-- /Content header -->

        <div class="content">

            <!--Businesses map view-->
            <div class="col-md-12">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Businesses</h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="close"></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">
                        <map-cluster :locations="{{ json_encode($businesses) }}">
                        </map-cluster>
                    </div>
                </div>
            </div>
            <!--END Businesses map view-->

        </div>

    </div>
@endsection
