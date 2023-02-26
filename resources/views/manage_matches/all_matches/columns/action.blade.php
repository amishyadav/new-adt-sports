<a href="javascript:void(0)" title="{{ __('messages.common.edit') }}"
   class="btn px-1 text-primary fs-3 match-edit-btn" data-bs-toggle="tooltip"
   data-bs-original-title="{{ __('messages.common.edit') }}" data-id="{{$row->id}}">
    <i class="fa-solid fa-pen-to-square"></i>
</a>
<a href="{{ route('matches.questions', $row->id) }}" data-id="{{ $row->id }}" title="{{ __('messages.common.question') }}"
   data-bs-toggle="tooltip"
   data-bs-original-title="{{ __('messages.common.question') }}"
   class="btn px-1 text-info fs-3 match-question-btn">
    <i class="fa-solid fa-question"></i>
</a>
