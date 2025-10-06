<div id="editTeamsModal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit Team</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'editTeamsForm','files' => 'true']) }}
            @method('put')
            <div class="modal-body">
                {{ Form::hidden('walk_through_id', null,['id' => 'teamsId']) }}
                <div class="alert alert-danger d-none hide" id="validationErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-md-12 mb-5">
                        {{ Form::label('name', 'Name', ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('name', null, ['id'=>'editTeamsName','class' => 'form-control','required','placeholder' => 'Name']) }}
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-5">
                            <div class="mb-3" io-image-input="true">
                                <label for="exampleInputImage" class="form-label">Logo:</label>
                                <div class="d-block">
                                    <div class="image-picker">
                                        <div class="image previewImage" id="editTeamImagePreview">
{{--                                             style="background-image: url({{ !empty($team->logo_image) ? $team->logo_image : asset('web/media/avatars/male.png') }})">--}}
                                        </div>
                                        <span class="picker-edit rounded-circle text-gray-500 fs-small" data-bs-toggle="tooltip"
                                              data-placement="top" data-bs-original-title="Edit">
                        <label>
                            <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                            <input type="file" id="profilePicture" name="profile" class="image-upload d-none" accept="image/*" />
                        </label>
                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('status','Status:',['class' => 'form-label']) }}
                        <div class="form-check form-switch">
                            <input class="form-check-input h-20px w-30px" type="checkbox"
                                   id="editTeamsStatus" name="status">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::button('Save', ['type' => 'submit','class' => 'btn btn-primary m-0','id' => 'editTeamsFormBtn','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Cancel</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
