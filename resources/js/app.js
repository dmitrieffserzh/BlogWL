/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
try {
    window.$ = window.jQuery = require('jquery');
 
    // BOOTSTRAP COMPONENTS
    require('./_bootstrap/util/index.js');

    // AJAX X-CSRF-TOKEN
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

} catch (e) {
    console.log(e)
}









// MODAL WINDOW
$(function () {
    $('.ajax').on('click', function (event) {

        event.preventDefault();

        // MODAL
        let modal_window    = $('.modal');
        let modal_container = $('.modal-dialog');
        let modal_content   = '.modal-body';

        // DATA
        let data_url        = $(this).data('url');
        let data_type       = $(this).data('type');
        let data_name       = $(this).data('name');
        let data_content    = $(this).data('content');
        let modal_size      = $(this).data('modal-size');

        if(modal_size) modal_window.find(modal_container).addClass(modal_size);

        modal_window.find(modal_container).append(
            '<div class="modal-content">' +
            '<div class="modal-header">' +
            '<h6 class="modal-title">' + data_name + '</h6>' +
            '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
            '<span aria-hidden="true">&times;</span>' +
            '</button>' +
            '</div>' +
            '<div class="modal-body">' +
            '</div>' +
            '</div>');

        if(data_url === '#') {
            modal_window.find(modal_content).append(data_content);
            modal_window.modal('show');
        } else {
            $.ajax({
                url: data_url,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: data_type,
                success: function (data) {
                    modal_window.find(modal_content).append(data);
                },
                complete: function () {
                    modal_window.modal('show');
                }
            });
        }

        if(data_content) {
            modal_window.find(modal_content).append(data_content);
        }

        // CLEAR MODAL CONTENT
        modal_window.on('hidden.bs.modal', function () {
            $(this).find(modal_container).children().remove();
            if(modal_size) modal_window.find(modal_container).removeClass(modal_size);
        });
    });
});
