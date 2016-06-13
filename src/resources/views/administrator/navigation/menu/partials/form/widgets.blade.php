<div class="content">
    <p class="callout callout-success">Below is a list of widgets that will be displayed when this menu was selected.</p>
    <table class="table table-bordered table-condensed table-hover">
        <thead>
        <tr>
            <th>Widget</th>
            <th>View Level</th>
            <th>Position</th>
            <th>Display</th>
        </tr>
        </thead>
        @forelse(\Yajra\CMS\Entities\Widget::query()->withoutGlobalScope('menu_assignment')->get() as $widget)
            <tr>
                <td>{{ $widget->title }}</td>
                <td>{{ $widget->authorized ? 'Private' : 'Public' }}</td>
                <td>{{ $widget->position }}</td>
                <td>
                    @if($widget->assignment == \Yajra\CMS\Entities\Widget::ALL_PAGES)
                        <span class="label bg-blue">All</span>
                    @elseif($menu->hasWidget($widget))
                        <span class="label bg-green">Yes</span>
                    @else
                        <span class="label bg-red">No</span>
                    @endif
                </td>
            </tr>
        @empty
            <li class="list-group-item">
                <p class="text-danger">No assigned widgets!</p>
            </li>
        @endforelse
    </table>
</div>