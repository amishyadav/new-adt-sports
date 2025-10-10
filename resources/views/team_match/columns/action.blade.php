@php
    use Illuminate\Support\Str;
    $slug = Str::slug($row->team1->name . '-vs-' . $row->team2->name);
    $matchID = \App\Models\TeamMatchScore::where('team_match_id', '=', $row->id)->pluck('id')->toArray();
@endphp

<a href="{{ route('team-match-score.index',['id' => $matchID[0], 'slug' => $slug]) }}" target="_blank"
   class="btn btn-outline-success me-2">
    Scoreboard
</a>
<a href="javascript:void(0)"
   class="btn btn-outline-warning">
    Timer
</a>
<a href="javascript:void(0)" title="Edit"
   class="btn px-1 text-primary fs-3 team-match-edit-btn" data-bs-toggle="tooltip"
   data-bs-original-title="Edit" data-id="{{$row->id}}" wire:key="{{$row->id}}">
    <i class="fa-solid fa-pen-to-square"></i>
</a>
<a href="javascript:void(0)" data-id="{{ $row->id }}" title="Delete"
   data-bs-toggle="tooltip"
   data-bs-original-title="Delete"
   class="btn px-1 text-danger fs-3 team-match-delete-btn">
    <i class="fa-solid fa-trash"></i>
</a>
