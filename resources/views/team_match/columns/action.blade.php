<a href="javascript:void(0)" title="Edit"
   class="btn px-1 text-primary fs-3 teams-edit-btn" data-bs-toggle="tooltip"
   data-bs-original-title="Edit" data-id="{{$row->id}}" wire:key="{{$row->id}}">
    <i class="fa-solid fa-pen-to-square"></i>
</a>
<a href="javascript:void(0)" data-id="{{ $row->id }}" title="Delete"
   data-bs-toggle="tooltip"
   data-bs-original-title="Delete"
   class="btn px-1 text-danger fs-3 teams-delete-btn">
    <i class="fa-solid fa-trash"></i>
</a>
