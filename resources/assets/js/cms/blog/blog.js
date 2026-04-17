let blogQuillData
let editBlogQuillData

document.addEventListener('turbo:load', loadBlogData)

function buildQuill (selector) {
    return new Quill(selector, {
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{ header: 1 }, { header: 2 }],
                [{ list: 'ordered' }, { list: 'bullet' }],
                [{ script: 'sub' }, { script: 'super' }],
                [{ indent: '-1' }, { indent: '+1' }],
                [{ direction: 'rtl' }],
                [{ size: ['small', false, 'large', 'huge'] }],
                [{ header: [1, 2, 3, 4, 5, 6, false] }],
                [{ color: [] }, { background: [] }],
                [{ font: [] }],
                [{ align: [] }],
                ['link', 'image', 'video'],
                ['clean'],
            ],
            keyboard: {
                bindings: {
                    tab: 'disabled',
                },
            },
        },
        placeholder: 'Enter Body',
        theme: 'snow',
    })
}

function syncSlug (sourceSelector, targetSelector) {
    const text = $.trim($(sourceSelector).val())
        .toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/(^-|-$)/g, '')

    $(targetSelector).val(text)
}

function validateBlogEditor (editor, hiddenSelector) {
    if (!editor || editor.getText().trim().length === 0) {
        displayErrorMessage('Description field is required.')
        return false
    }

    $(hiddenSelector).val(editor.root.innerHTML)
    return true
}

function resetBlogForm (formSelector, editor, hiddenSelector) {
    $(formSelector)[0].reset()
    $(hiddenSelector).val('')

    if (editor) {
        editor.setContents([{ insert: '' }])
    }
}

function loadBlogData () {
    if (!$('#addBlogForm').length || !$('#editBlogForm').length) {
        return
    }

    if (!blogQuillData) {
        blogQuillData = buildQuill('#blogQuillData')
    }

    if (!editBlogQuillData) {
        editBlogQuillData = buildQuill('#editBlogQuillData')
    }
}

listenClick('#addBlogModalBtn', function () {
    $('#addBlogModal').modal('show').appendTo('body')
})

listenHiddenBsModal('#addBlogModal', function () {
    resetBlogForm('#addBlogForm', blogQuillData, '#blogDescription')
})

listenHiddenBsModal('#editBlogModal', function () {
    resetBlogForm('#editBlogForm', editBlogQuillData, '#editBlogDescription')
    $('#editBlogId').val('')
})

listen('keyup', '#blogTitle', function () {
    syncSlug('#blogTitle', '#blogSlug')
})

listen('keyup', '#editBlogTitle', function () {
    syncSlug('#editBlogTitle', '#editBlogSlug')
})

listenSubmit('#addBlogForm', function (event) {
    event.preventDefault()

    if (!validateBlogEditor(blogQuillData, '#blogDescription')) {
        return false
    }

    $('#blogAddBtn').prop('disabled', true)
    $.ajax({
        url: route('blog.store'),
        type: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                livewire.emit('refresh')
                $('#addBlogModal').modal('hide')
            }

            $('#blogAddBtn').prop('disabled', false)
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#blogAddBtn').prop('disabled', false)
        },
    })
})

listenClick('.blog-edit-btn', function (event) {
    const blogId = $(event.currentTarget).data('id')

    $.ajax({
        url: route('blog.edit', blogId),
        type: 'GET',
        success: function (result) {
            const blog = result.data

            $('#editBlogId').val(blog.id)
            $('#editBlogTag').val(blog.tag)
            $('#editBlogTitle').val(blog.title)
            $('#editBlogSlug').val(blog.slug)
            $('#editBlogDescription').val(blog.description)
            editBlogQuillData.root.innerHTML = blog.description ?? ''
            $('#editBlogModal').modal('show').appendTo('body')
        },
    })
})

listenSubmit('#editBlogForm', function (event) {
    event.preventDefault()

    if (!validateBlogEditor(editBlogQuillData, '#editBlogDescription')) {
        return false
    }

    const blogId = $('#editBlogId').val()
    $('#editBlogBtn').prop('disabled', true)
    $.ajax({
        url: route('blog.update', blogId),
        type: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (result) {
            if (result.success) {
                displaySuccessMessage(result.message)
                livewire.emit('refresh')
                $('#editBlogModal').modal('hide')
            }

            $('#editBlogBtn').prop('disabled', false)
        },
        error: function (result) {
            displayErrorMessage(result.responseJSON.message)
            $('#editBlogBtn').prop('disabled', false)
        },
    })
})

listenClick('.blog-delete-btn', function (event) {
    const blogID = $(event.currentTarget).data('id')
    deleteItem(route('blog.destroy', blogID), 'Blog')
})
