<div id="editBlogModal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{ __('messages.common.edit') }} {{ __('messages.common.blog') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{ Form::open(['id' => 'editBlogForm', 'files' => true]) }}
            @method('PUT')
            <div class="modal-body">
                {{ Form::hidden('blog_id', null, ['id' => 'editBlogId']) }}
                <div class="row">
                    <div class="form-group col-md-6 mb-5">
                        {{ Form::label('tag', __('messages.blog.tag').':', ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('tag', null, ['id' => 'editBlogTag', 'class' => 'form-control', 'required', 'placeholder' => __('messages.blog.tag')]) }}
                    </div>
                    <div class="form-group col-md-6 mb-5">
                        {{ Form::label('title', __('messages.blog.title').':', ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('title', null, ['id' => 'editBlogTitle', 'class' => 'form-control', 'required', 'placeholder' => __('messages.blog.title')]) }}
                    </div>
                    <div class="form-group col-md-12 mb-5">
                        {{ Form::label('slug', __('messages.blog.slug').':', ['class' => 'form-label']) }}
                        <span class="required"></span>
                        {{ Form::text('slug', null, ['id' => 'editBlogSlug', 'class' => 'form-control', 'required', 'placeholder' => __('messages.blog.slug')]) }}
                    </div>
                    <div class="form-group col-md-12 mb-5">
                        {{ Form::label('image', __('messages.blog.image').':', ['class' => 'form-label']) }}
                        {{ Form::file('image', ['class' => 'form-control', 'accept' => '.jpg,.jpeg,.png,.webp']) }}
                    </div>
                    <div class="form-group col-md-12 mb-5">
                        {{ Form::label('description', __('messages.blog.description').':', ['class' => 'form-label']) }}
                        <span class="required"></span>
                        <div id="editBlogQuillData" class="h-300px"></div>
                        {{ Form::hidden('description', null, ['id' => 'editBlogDescription']) }}
                    </div>
                </div>
            </div>
            <div class="modal-footer pt-0">
                {{ Form::button(__('messages.common.save'), ['type' => 'submit', 'class' => 'btn btn-primary m-0', 'id' => 'editBlogBtn']) }}
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.common.cancel') }}</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
