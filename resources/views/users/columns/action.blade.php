<div class="d-flex justify-content-center">
    <a href="{{route('users.edit',$row->id)}}" title="{{ __('messages.common.edit') }}"
       class="btn px-2 text-primary fs-2 user-edit-btn" data-id="{{$row->id}}"  data-bs-toggle="tooltip"
       data-bs-original-title="{{ __('messages.common.edit') }}">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>
    <a href="javascript:void(0)" data-id="{{ $row->id }}" title="{{ __('messages.common.delete') }}"
       class="btn px-2 text-danger fs-2 user-delete-btn"  data-bs-toggle="tooltip"
       data-bs-original-title="{{ __('messages.common.delete') }}">
        <i class="fa-solid fa-trash"></i>
    </a>
</div>
