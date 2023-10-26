<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel Form Demo</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" rel="stylesheet">    
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        <div class="container-md mt-5">
            <div class="col-xxl-5 col-xl-6 col-lg-8 mx-auto">
                    <h1 class="fw-bold mb-5">Laravel 10 dropzone image upload with other form fields and validation</h1>
                    <form action="{{ route('form.submit') }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="form-group mb-3">
                            <label class="form-label text-muted opacity-75 fw-medium" for="formName">Name</label>
                            <input class="form-control p-3 fw-bold" id="formName" name="formName" type="text">
                            @error('formName')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label text-muted opacity-75 fw-medium" for="formEmail">Email</label>
                            <input class="form-control p-3 fw-bold" id="formEmail" name="formEmail" type="email">
                            @error('formEmail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label class="form-label text-muted opacity-75 fw-medium" for="formImage">Image</label>
                            <input class="d-none" id="formImage" type="file">
                            <div id="dropzoneDragArea" class="dropzone dropzone-drag-area form-control">
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
                        <button class="btn btn-primary fw-medium py-3 px-4 mt-3" id="formSubmit">Submit Form</button>
                    </form>
            </div>
        </div>
    </body>
</html>