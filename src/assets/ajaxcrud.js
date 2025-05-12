/*!
 * Ajax Crud 
 * =================================
 * Use for spicytuna8/yii2-ajaxcrud extension
 * Original: johnitvn/yii2-ajaxcrud
 * Updated for Bootstrap 5 with loader modal
 * @authors 
 *   Spicytuna8 hendra.account@gmail.com
 *   John Martin john.itvn@gmail.com
 */

$(document).ready(function () {

    // Create instance of Modal Remote
    // This instance will be the controller of all business logic of modal
    // Backwards compatible lookup of old ajaxCrubModal ID
    let modal;
    if ($('#ajaxCrubModal').length > 0 && $('#ajaxCrudModal').length == 0) {
        modal = new ModalRemote('#ajaxCrubModal');
    } else {
        modal = new ModalRemote('#ajaxCrudModal');
    }

    // Function to show loader
    function showLoader() {
        const loaderHtml = `
            <div class="modal-backdrop fade show"></div>
            <div class="modal" id="loaderModal" tabindex="-1" aria-hidden="true" style="display:block;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content bg-transparent border-0">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;
        $('body').append(loaderHtml);
    }

    // Function to hide loader
    function hideLoader() {
        $('#loaderModal').remove();
        $('.modal-backdrop').remove();
    }

    // Catch click event on all buttons that want to open a modal
    $(document).on('click', '[role="modal-remote"]', function (event) {
        event.preventDefault();

        // Show loader
        showLoader();

        // Open modal after a short delay to simulate loading
        setTimeout(() => {
            modal.open(this, null);
            hideLoader();
        }); // Adjust delay as needed
    });

    // Catch click event on all buttons that want to open a modal with bulk action
    $(document).on('click', '[role="modal-remote-bulk"]', function (event) {
        event.preventDefault();

        // Show loader
        showLoader();

        // Collect all selected IDs
        var selectedIds = [];
        var selection = 'selection';
        if ($(this).data("selector") != null) {
            selection = $(this).data("selector");
        }

        $('input:checkbox[name="' + selection + '[]"]').each(function () {
            if (this.checked) selectedIds.push($(this).val());
        });

        setTimeout(() => {
            if (selectedIds.length == 0) {
                // If no selected IDs, show warning
                hideLoader();
                modal.show();
                modal.setTitle('No selection');
                modal.setContent('You must select item(s) to use this action');
                modal.addFooterButton("Close", 'button', 'btn btn-md btn-default', function (button, event) {
                    this.hide();
                });
            } else {
                // Open modal with selected IDs
                modal.open(this, selectedIds);
                hideLoader();
            }
        }, 500); // Adjust delay as needed
    });
});
