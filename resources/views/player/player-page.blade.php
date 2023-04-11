<div class="players-section profile-content d-none">
    @if(getRegisteredPlayerPermission())
    <form class="form-card" method="post" action="{{ route('front.team.player') }}">
        @csrf
        <div class="row justify-content-between text-left d-flex">
            <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Player ID:
                    <span class="text-danger"> *</span>
                </label>
                <input type="text" id="teamName" name="unique_code" placeholder="Enter Player ID" class="form-control">
            </div>
        </div>

        <div class="row justify-content-end">
            <div class="form-group col-sm-6">
                <button type="submit" class="btn btn-primary">Add Player</button>
            </div>
        </div>
    </form>
    @endif
    @if(!empty($teamPlayer))
        <h5>Team Captain: {{ $captain->user->full_name }}</h5>
    @endif
    <h1>Players</h1>
    <div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Profile</th>
            <th scope="col">Full Name</th>
            <th scope="col">Player ID</th>
            <th scope="col">Position</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($teamPlayer))
        @foreach($teamPlayer as $player)
        <tr>
            <th>
                <img src="{{ $player->user->profile_image }}" alt="" height="50px" width="50px">
            </th>
            <td>{{ $player->user->full_name }}</td>
            <td>{{ $player->user->unique_code }}</td>
            <td>
                {{ $player->user->position }}
                @if($player->user->position === 'Defender')
                    ({{$player->user->position_type}})
                @endif
            </td>
        </tr>
        @endforeach
        @endif
        </tbody>
    </table>
    </div>
</div>
