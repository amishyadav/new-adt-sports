<div class="team-section d-none profile-content">
    <form class="form-card" method="post" action="{{ route('front.team.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row justify-content-between text-left">
            <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Team Name:
                    <span class="text-danger"> *</span>
                </label>
                <input type="text" id="teamName" name="name" placeholder="Enter your team name" class="form-control" value="{{ !empty($team) ? $team->name : null }}" required {{getRegisteredPlayerPermission() ? '' : 'disabled'}}>
            </div>

            <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Team Logo:
                    <span class="text-danger"> *</span>
                </label>
                <div class="avatar-upload">
                    <div class="avatar-edit">
                        <input type='file' name="team_logo" id="imageUpload" accept=".png, .jpg, .jpeg" />
                        @if(getRegisteredPlayerPermission())
                        <label for="imageUpload"></label>
                        @endif
                    </div>
                    <div class="avatar-preview">
                        <div id="imagePreview" style="background-image: url({{!empty($team) ? $team->team_logo : asset(getAppLogo())}});">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(getRegisteredPlayerPermission())
        <div class="row justify-content-end">
            <div class="form-group col-sm-6">
                <button type="submit" class="btn btn-primary">Add Team</button>
            </div>
        </div>
        @endif
    </form>
</div>
