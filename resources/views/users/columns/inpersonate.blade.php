
<a data-turbo="false" title="Impersonate {{$row->full_name}}" class="btn btn-sm btn-primary me-5"
   style="width: fit-content;" href="{{route('impersonate', $row->id)}}">
    {{__('messages.common.impersonate')}}
</a>

