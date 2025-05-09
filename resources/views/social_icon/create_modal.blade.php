<div id="addSocialIconModal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">{{ __('Add Social Icon') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'addSocialIconForm','files' => 'true']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="validationErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-md-12 mb-5">
                        {{ Form::label('title', __('Title').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('title', null, ['id'=>'title','class' => 'form-control','required' ,'placeholder' => __('Title')]) }}
                    </div>
                    <div class="form-group col-md-12 mb-5">
                        {{ Form::label('icon', __('Select Icon').(':'), ['class' => 'form-label']) }}
                        <div class="input-group">
                            {{ Form::text('icon', null, ['id'=>'socialIconValue','class' => 'form-control icon h-auto' ,'placeholder' => 'Select Icon']) }}
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary" data-icon="fas fa-home" role="iconpicker" id="socialIconPicker" data-iconset="fontawesome5"><i class="fas fa-home"></i><input type="hidden" value="las la-home"><span class="caret"></span></button>

                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12 mb-5">
                        {{ Form::label('url', __('URL').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('url', null, ['id'=>'url','class' => 'form-control','required' ,'placeholder' => __('URL')]) }}
                    </div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary m-0','id' => 'socialIconAddBtn','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
