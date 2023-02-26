<div id="addMatchModal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">{{ __('messages.matches.add_match') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            {{ Form::open(['id'=>'addMatchForm','files' => 'true']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none hide" id="validationErrorsBox"></div>
                <div class="row">
                    <div class="form-group col-md-12 mb-5">
                        {{ Form::label('match_title', __('messages.matches.match_title').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('match_title', null, ['id'=>'matchTitle','class' => 'form-control','required' ,'placeholder' => __('messages.matches.match_title')]) }}
                    </div>
                    <div class="form-group col-md-12 mb-5">
                        {{ Form::label('league_id', __('messages.matches.league').(':'), ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::select('league_id', $league, '', [
                           'class' => 'form-select', 'aria-label'=> __('messages.matches.select_league'),
                           'data-control'=>'select2']) }}
                    </div>
                    <div class="form-group col-md-12 mb-5">
                        <div class="mb-5">
                            {{ Form::label('start_from', __('messages.matches.betting_starts_from').':', ['class' => 'form-label required']) }}
                            {{ Form::text('start_from', null, ['class' => 'form-control start-from', 'id' => 'startFrom','placeholder' => __('messages.matches.betting_starts_from')]) }}
                        </div>
                    </div>
                    <div class="form-group col-md-12 mb-5">
                        <div class="mb-5">
                            {{ Form::label('end_at', __('messages.matches.betting_ends_at').':', ['class' => 'form-label required']) }}
                            {{ Form::text('end_at', null, ['class' => 'form-control end-at', 'id' => 'endAt','placeholder' => __('messages.matches.betting_ends_at')]) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::button(__('messages.common.save'), ['type' => 'submit','class' => 'btn btn-primary m-0','id' => 'matchAddBtn','data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
