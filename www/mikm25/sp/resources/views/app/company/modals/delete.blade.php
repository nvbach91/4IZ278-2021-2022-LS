<div class="modal fade" id="company-delete-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('companies.modals.delete.title') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0">{{ __('companies.modals.delete.text') }}</p>

                <form action="#" method="post" id="company-delete-form">
                    {{ csrf_field() }}
                    @method('delete')
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('common.buttons.close') }}</button>
                <button type="submit" form="company-delete-form"
                        class="btn btn-danger">{{ __('common.buttons.delete') }}</button>
            </div>
        </div>
    </div>
</div>