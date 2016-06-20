<div class="actions">
    <div class="btn-group submenu">
        <button class="btn btn-default btn-sm"
                data-toggle="dropdown"
                data-hover="dropdown"
                data-close-others="true"
        >
            <i class="fa fa-wrench"></i>
            <span>Manage</span>
            <i class="fa fa-angle-down"></i>
        </button>
        <ul class="dropdown-menu pull-right" role="menu">
            <li>
                <button data-href="{{ route('administrator.users.edit', $id) }}"
                        class="btn btn-link"
                >
                    <i class="fa fa-pencil"></i> {{trans('cms::user.edit-user')}}
                </button>
            </li>
            <li>
                <button data-href="{{ route('administrator.users.password', $id) }}"
                        class="btn btn-link"
                >
                    <i class="fa fa-refresh"></i> {{trans('cms::user.change-password')}}
                </button>
            </li>
            @if($id <> auth('administrator')->id())
                @if(!$confirmed)
                    <li>
                        <button data-ajax="{!! route('administrator.users.activate', $id) !!}"
                                class="btn btn-link"
                        >
                            <i class="fa fa-play"></i> {{trans('cms::user.activate')}}
                        </button>
                    </li>
                @else
                    <li>
                        <button data-ajax="{!! route('administrator.users.activate', $id) !!}"
                                class="btn btn-link"
                        >
                            <i class="fa fa-pause"></i> {{trans('cms::user.deactivate')}}
                        </button>
                    </li>
                @endif

                @if($blocked)
                    <li>
                        <button data-ajax="{!! route('administrator.users.block', $id) !!}"
                                class="btn btn-link"
                        >
                            <i class="fa fa-check"></i> {{trans('cms::user.unblock')}}
                        </button>
                    </li>
                @else
                    <li>
                        <button data-ajax="{!! route('administrator.users.block', $id) !!}"
                                class="btn btn-link"
                        >
                            <i class="fa fa-ban"></i> {{trans('cms::user.block')}}
                        </button>
                    </li>
                @endif
                <li>
                    <button data-remote="{!! route('administrator.users.destroy', $id) !!}"
                            class="btn btn-link btn-delete"
                    >
                        <i class="fa fa-trash"></i> {{trans('cms::user.delete')}}
                    </button>
                </li>
                <li>
                    <button data-href="{!! route('administrator.users.show', $id) !!}"
                            class="btn btn-link"
                    >
                        <i class="fa fa-eye"></i> {{trans('cms::user.view')}}
                    </button>
                </li>
            @endif
        </ul>
    </div>
</div>
