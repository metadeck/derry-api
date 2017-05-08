<!-- Page header -->
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            @if(isset($call_to_action))
                <a href="{{ $call_to_action['link'] }}" class="btn btn-primary pull-right">{{ $call_to_action['text'] }}</a>
            @endif
            <h4>{{ $page_title }}</h4>
        </div>
        @if(isset($heading_elements))
            <div class="heading-elements">
                <div class="heading-btn-group">
                    @foreach($heading_elements as $heading_element)
                        <a href="{{ $heading_element['link'] }}" class="btn btn-link btn-float has-text"><i class="{{ $heading_element['icon'] }} text-primary"></i><span>{{ $heading_element['text'] }}</span></a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            @foreach($page_breadcrumbs as $page_breadcrumb)
                @if(isset($page_breadcrumb['link']))
                    <li><a href="{{ $page_breadcrumb['link'] }}"><i class="{{ $page_breadcrumb['icon_class'] }} position-left"></i> {{ $page_breadcrumb['title'] }}</a></li>
                @else
                    <li class="active"><a> <i class="{{ $page_breadcrumb['icon_class'] }}"></i> {{ $page_breadcrumb['title'] }}</a></li>
                @endif
            @endforeach
        </ul>
    </div>
</div>
<!-- /page header -->