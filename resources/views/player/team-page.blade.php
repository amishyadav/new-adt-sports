<div class="team-section d-none profile-content">
    <form class="form-card" method="post" action="{{ route('front.team.store') }}">
        @csrf
        <div class="row justify-content-between text-left">
            <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Team Name:
                    <span class="text-danger"> *</span>
                </label>
                <input type="text" id="teamName" name="name" placeholder="Enter your team name" class="form-control" value="{{ !empty($user->team) ? $user->team->name : null }}" required>
            </div>
        </div>

        <div class="row justify-content-end">
            <div class="form-group col-sm-6">
                <button type="submit" class="btn btn-primary">Add Team</button>
            </div>
        </div>
    </form>
</div>
