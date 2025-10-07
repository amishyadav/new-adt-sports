<div id="editTeamMatchModal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit Team</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'editTeamMatchForm','files' => 'true']) }}
            @method('put')
            <div class="modal-body">
                {{ Form::hidden('team_match', null,['id' => 'teamMatchId']) }}
                <div class="alert alert-danger d-none hide" id="validationErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-md-12 mb-5">
                        {{ Form::label('name', 'Team 1:', ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::select('team1_id',$teams, null, ['id' => 'editTeamMatchTeam1Name', 'class' => 'form-control', 'placeholder'=> 'Select Team', 'required']) }}
                    </div>

                    <div class="form-group col-md-12 mb-5">
                        {{ Form::label('name', 'Team 2:', ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::select('team2_id',$teams, null, ['id' => 'editTeamMatchTeam2Name', 'class' => 'form-control', 'placeholder'=> 'Select Team', 'required']) }}
                    </div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::button('Save', ['type' => 'submit','class' => 'btn btn-primary m-0','id' => 'editTeamMatchFormBtn','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Cancel</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
