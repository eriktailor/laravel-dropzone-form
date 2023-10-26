<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel Form Demo</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" rel="stylesheet">    
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            .dropzone {
                overflow-y: auto;
                padding: 10px 10px 0 !important;
            }
            .dz-preview {
                width: 100%;
                margin: 0 !important;
                height: 100%;
                padding: 20px;
            }
            .dz-photo {
                height: 100%;
                width: 100%;
                overflow: hidden;
                border-radius: 12px;
                background: #eae7e2;
            }
            .dz-thumbnail {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
            .dz-image {
                width: 90px !important;
                height: 90px !important;
                border-radius: 6px !important;
            }
            .dz-remove {
                display: none !important;
            }
            .dz-delete {
                width: 24px;
                height: 24px;
                cursor: pointer;
                background: rgba(0, 0, 0, 0.57);
                position: absolute;
                opacity: 0;
                transition: all 0.2s ease;
                top: 30px;
                right: 30px;
                border-radius: 100px;
                z-index: 9999;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .dz-delete > svg {
                transform: scale(0.75);
            }
            .dz-preview:hover .dz-delete, .dz-preview:hover .dz-remove-image {
                opacity: 1;
            }
            .dz-message {
                height: 100%;
                margin: 0 !important;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .dropzone-drag-area {
                height: 300px;
                position: relative;
                padding: 0 !important;
                border-radius: 10px;
                border: 3px dashed #dbdeea;
            }
        </style>
    </head>
    <body class="bg-light">

        <!-- Form container -->
        <div class="container-md mt-5">
            <div class="col-xxl-5 col-xl-6 col-lg-8 mx-auto">
                <h1 class="fw-bold mb-5">Laravel 10 dropzone image upload with other form fields and validation</h1>
                @if(session()->has('message'))
                    <div class="alert alert-success mb-4">{{ session()->get('message') }}</div>
                @endif
                <form class="dropzone" id="formDropzone" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="form-group mb-3">
                        <label class="form-label text-muted opacity-75 fw-medium" for="formName">Name</label>
                        <input class="form-control p-3 fw-bold @error('name') is-invalid @enderror" id="formName" name="name" value="{{ old('name') }}" type="text" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label text-muted opacity-75 fw-medium" for="formEmail">Email</label>
                        <input class="form-control p-3 fw-bold @error('email') is-invalid @enderror" id="formEmail" name="email" value="{{ old('email') }}" type="email" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label class="form-label text-muted opacity-75 fw-medium" for="formImage">Image</label>
                        <div class="dropzone-drag-area form-control">
                            <div class="dz-message text-muted opacity-50" data-dz-message>
                                <span>Drag file here to upload</span>
                            </div>
                        </div>
                        <div class="d-none" id="dzPreviewContainer">
                            <div class="eeee dz-preview dz-file-preview">
                                <div class="dz-photo">
                                    <img class="dz-thumbnail" data-dz-thumbnail>
                                </div>
                                <div class="dz-delete" data-dz-remove>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="times"><path fill="#FFFFFF" d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary fw-medium py-3 px-4 mt-3" id="formSubmit" type="submit">Submit Form</button>
                </form>
            </div>
        </div>

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            Dropzone.autoDiscover = false;

            $('#formDropzone').dropzone({
                previewTemplate: $('#dzPreviewContainer').html(),
                url: '/form-submit',
                addRemoveLinks: true,
                autoProcessQueue: false,       
                uploadMultiple: false,
                parallelUploads: 1,
                maxFiles: 1,
                acceptedFiles: '.jpeg, .jpg, .png, .gif',
                thumbnailWidth: 900,
                thumbnailHeight: 600,
               
                init: function() 
                {
                    myDropzone = this;

                    // submit button clicked
                    $('#formSubmit').on('click', function(event) {
                        event.preventDefault();
                        event.stopPropagation();

                        myDropzone.processQueue();
                    });
                },
                success: function(file, response) 
                {
                    console.log('Successssss: '+response);
                    //$('#form').submit();
                },
                error: function(file, response)
                {
                    console.log('Error: '+response);
                    return false;
                }
            });

        </script>
    </body>
</html>