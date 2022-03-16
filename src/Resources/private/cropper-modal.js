function createModal() {
    let modalHtml = `
        <div class="modal fade" id="cropperModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document" style="height: 90%;">
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header d-flex justify-content-between align-items-center">
                <h4 class="modal-title" id="myModalLabel">Cropper</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    `;
    let modal = document.createElement('div');
    modal.innerHTML = modalHtml;
    document.body.appendChild(modal);
}

function setContentForCropperModal(src) {
    let cropperIframe = document.createElement('iframe');
    cropperIframe.src = src;
    cropperIframe.style.cssText = 'width:100%;height:100%;border:0;';
    document.querySelector('#cropperModal .modal-body').innerHTML = '';
    document.querySelector('#cropperModal .modal-body').appendChild(cropperIframe);
}

window.onload = function () {
    'use strict';

    createModal();

    let openCropperButtons = document.querySelectorAll('.cropper-open-modal');
    openCropperButtons.forEach(button => {
        button.addEventListener('click', button => {
            setContentForCropperModal(button.target.getAttribute('data-src'))
        })
    });


}
