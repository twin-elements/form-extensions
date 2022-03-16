import 'bootstrap/dist/js/bootstrap';

import Loader from 'root-dir/assets/js/Loader';
import Alert from 'root-dir/assets/js/Alert';
import Cropper from 'cropperjs/dist/cropper';

window.onload = function () {
    'use strict';

    var URL = window.URL || window.webkitURL;
    var image = document.getElementById('cropped-image');
    var actions = document.getElementById('actions');
    var options = {
        aspectRatio: '16 / 9',
    };

    var originalImageURL = image.src;
    var mimeType = originalImageURL.split('.').pop();

    if (mimeType == 'png') {
        var uploadedImageType = 'image/png';
    } else {
        var uploadedImageType = 'image/jpeg';
        options.fillColor = '#fff';
    }

    var cropper = new Cropper(image, options);

    let uploadedImageURL;

    // Buttons
    if (!document.createElement('canvas').getContext) {
        $('button[data-method="getCroppedCanvas"]').prop('disabled', true);
    }

    if (typeof document.createElement('cropper').style.transition === 'undefined') {
        $('button[data-method="rotate"]').prop('disabled', true);
        $('button[data-method="scale"]').prop('disabled', true);
    }

    // Options
    actions.querySelector('.docs-toggles').onchange = function (event) {
        var e = event || window.event;
        var target = e.target || e.srcElement;
        var cropBoxData;
        var canvasData;
        var isCheckbox;
        var isRadio;

        if (!cropper) {
            return;
        }

        if (target.tagName.toLowerCase() === 'label') {
            target = target.querySelector('input');
        }

        isCheckbox = target.type === 'checkbox';
        isRadio = target.type === 'radio';

        if (isCheckbox || isRadio) {
            if (isCheckbox) {
                options[target.name] = target.checked;
                cropBoxData = cropper.getCropBoxData();
                canvasData = cropper.getCanvasData();

                options.ready = function () {
                    console.log('ready');
                    cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
                };
            } else {
                options[target.name] = target.value;
                options.ready = function () {
                    console.log('ready');
                };
            }

            // Restart
            cropper.destroy();
            cropper = new Cropper(image, options);
        }
    };

    // Methods
    actions.querySelector('.docs-buttons').onclick = function (event) {
        var e = event || window.event;
        var target = e.target || e.srcElement;
        var cropped;
        var result;
        var input;
        var data;

        if (!cropper) {
            return;
        }

        while (target !== this) {
            if (target.getAttribute('data-method')) {
                break;
            }

            target = target.parentNode;
        }

        if (target === this || target.disabled || target.className.indexOf('disabled') > -1) {
            return;
        }

        data = {
            method: target.getAttribute('data-method'),
            target: target.getAttribute('data-target'),
            option: target.getAttribute('data-option') || undefined,
            secondOption: target.getAttribute('data-second-option') || undefined
        };

        cropped = cropper.cropped;

        if (data.method) {
            if (typeof data.target !== 'undefined') {
                input = document.querySelector(data.target);

                if (!target.hasAttribute('data-option') && data.target && input) {
                    try {
                        data.option = JSON.parse(input.value);
                    } catch (e) {
                        console.log(e.message);
                    }
                }
            }

            switch (data.method) {
                case 'rotate':
                    if (cropped && options.viewMode > 0) {
                        cropper.clear();
                    }

                    break;

                case 'getCroppedCanvas':
                    try {
                        data.option = JSON.parse(data.option);
                    } catch (e) {
                        console.log(e.message);
                    }

                    if (uploadedImageType === 'image/jpeg') {
                        if (!data.option) {
                            data.option = {};
                        }

                        data.option.fillColor = '#fff';
                    }

                    break;
            }

            result = cropper[data.method](data.option, data.secondOption);

            switch (data.method) {
                case 'rotate':
                    if (cropped && options.viewMode > 0) {
                        cropper.crop();
                    }

                    break;

                case 'scaleX':
                case 'scaleY':
                    target.setAttribute('data-option', -data.option);
                    break;

                case 'destroy':
                    cropper = null;

                    if (uploadedImageURL) {
                        URL.revokeObjectURL(uploadedImageURL);
                        uploadedImageURL = '';
                        image.src = originalImageURL;
                    }

                    break;
            }

            if (typeof result === 'object' && result !== cropper && input) {
                try {
                    input.value = JSON.stringify(result);
                } catch (e) {
                    console.log(e.message);
                }
            }
        }
    };

    document.body.onkeydown = function (event) {
        var e = event || window.event;

        if (e.target !== this || !cropper || this.scrollTop > 300) {
            return;
        }

        switch (e.keyCode) {
            case 37:
                e.preventDefault();
                cropper.move(-1, 0);
                break;

            case 38:
                e.preventDefault();
                cropper.move(0, -1);
                break;

            case 39:
                e.preventDefault();
                cropper.move(1, 0);
                break;

            case 40:
                e.preventDefault();
                cropper.move(0, 1);
                break;
        }
    };

    document.querySelectorAll('.do-crop').forEach(function (button) {
        let action = button.getAttribute('data-action');

        button.addEventListener('click', function () {

            Loader.loaderOn();
            cropper.getCroppedCanvas({
                fillColor: typeof mimeType == 'png' ? '' : '#fff'
            }).toBlob(function (blob) {

                let formData = new FormData();

                formData.append('croppedImage', blob);

                let cropData = cropper.getData();
                formData.append('dataImage', JSON.stringify(cropData));
                formData.append('ratio', options.aspectRatio);
                formData.append('originalImagePath', ORIGINAL_IMAGE_PATH)

                fetch(Routing.generate('crop_filemanager_image'), {
                    method: 'post',
                    credentials: 'same-origin',
                    headers: new Headers({
                        'X-Requested-With': 'XMLHttpRequest'
                    }),
                    body: formData
                }).then((response) => {
                    if (!response.ok) {
                        throw new Error(response.statusText);
                    }
                    return response.json()
                }).then((response) => {

                    if (response.error) {
                        throw new Error(response.error);
                    }

                    let croppedImagePath = response.croppedImagePath;

                    if (action === 'crop-and-change-image') {
                        parent.document.getElementById("crop-" + FORM_ID).src = croppedImagePath;
                        parent.document.getElementById(FORM_ID).value = croppedImagePath;
                    }

                    window.parent.$('#cropperModal').modal('hide');

                    Loader.loaderOff();
                }).catch((error) => {
                    Alert.errorMessage(error);
                    Loader.loaderOff();
                });
            }, uploadedImageType)
        });
    }.bind(cropper));
};
