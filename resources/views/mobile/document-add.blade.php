@extends('mobile.layout.master')

@section('title') Upload Document @endsection

@push('css')
    <link rel='stylesheet'
          href='https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css'>
    <link rel='stylesheet' href='https://unpkg.com/filepond/dist/filepond.min.css'>
    <style>
        .filepond--credits {
            display: none;
        }

        .filepond--root {

        }

        .filepond--panel-root {
            background-color: #fff;
            border: 2px solid #E8ECEF;
        }

        .filepond--drop-label {

            margin: 0px 10px !important;
            color: #4f4f4f;
            display: flex;
            justify-content: flex-start !important;
            align-items: center !important;
            height: 0;

        }

        .filepond--drop-label label {
            font-weight: 400;
            text-align: left;
            line-height: 17px;
        }


    </style>
@endpush

@section('content')


    <div class="appHeader  bg-secondary">
        <div class="left">
            <a href="{{ url('mobile/documents') }}" class="headerButton">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13 14.5L10.5 12L13 9.5" stroke="#FF885B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M8.95043 20.6471C6.17301 19.9956 4.00437 17.827 3.35288 15.0496C2.88237 13.0437 2.88237 10.9563 3.35288 8.95043C4.00437 6.17301 6.17301 4.00437 8.95044 3.35288C10.9563 2.88237 13.0437 2.88238 15.0496 3.35288C17.827 4.00437 19.9956 6.17301 20.6471 8.95043C21.1176 10.9563 21.1176 13.0437 20.6471 15.0496C19.9956 17.827 17.827 19.9956 15.0496 20.6471C13.0437 21.1176 10.9563 21.1176 8.95043 20.6471Z" stroke="#FF885B" stroke-width="1.5"/>
                    <path d="M8.95046 20.6471C10.9563 21.1176 13.0438 21.1176 15.0496 20.6471C17.827 19.9956 19.9957 17.827 20.6472 15.0496C21.1177 13.0437 21.1177 10.9563 20.6472 8.95043C19.9957 6.17301 17.827 4.00437 15.0496 3.35288C13.0438 2.88237 10.9563 2.88237 8.95046 3.35288C6.17304 4.00437 4.0044 6.17301 3.35291 8.95043" stroke="#0F5ABB" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
            </a>
        </div>
        <div class="pageTitle">
            Documents
        </div>
        <div class="right">
            <a href="#" data-bs-toggle="modal" data-bs-target="#optionwindow" class="headerButton  toggle-searchbox">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.7517 4.69329C13.7517 3.85839 13.1416 3.14883 12.3161 3.0238C12.1066 2.99207 11.8935 2.99207 11.6839 3.0238C10.8584 3.14883 10.2482 3.85839 10.2482 4.6933V5.87397C9.77662 6.00858 9.32734 6.19618 8.90726 6.42992L8.07205 5.59471C7.48168 5.00435 6.54849 4.93407 5.87637 5.42937C5.70578 5.55509 5.55509 5.70578 5.42937 5.87637C4.93407 6.54849 5.00434 7.4817 5.59471 8.07207L6.42992 8.90728C6.19617 9.32735 6.00857 9.77663 5.87397 10.2483H4.6933C3.85839 10.2483 3.14883 10.8584 3.0238 11.6839C2.99207 11.8935 2.99207 12.1066 3.0238 12.3161C3.14883 13.1416 3.85839 13.7518 4.69329 13.7518H5.87396C6.00857 14.2234 6.19617 14.6727 6.42992 15.0927L5.59471 15.9279C5.00434 16.5183 4.93407 17.4515 5.42937 18.1236C5.55509 18.2942 5.70578 18.4449 5.87638 18.5706C6.5485 19.0659 7.48169 18.9957 8.07205 18.4053L8.90726 17.5701C9.32734 17.8038 9.77662 17.9914 10.2482 18.126V19.3067C10.2482 20.1416 10.8584 20.8512 11.6839 20.9762C11.8934 21.0079 12.1066 21.0079 12.3161 20.9762C13.1416 20.8512 13.7517 20.1416 13.7517 19.3067V18.1261C14.2234 17.9914 14.6727 17.8038 15.0927 17.5701L15.9279 18.4053C16.5183 18.9957 17.4515 19.0659 18.1236 18.5706C18.2942 18.4449 18.4449 18.2942 18.5706 18.1236C19.0659 17.4515 18.9957 16.5183 18.4053 15.928L17.5701 15.0928C17.8038 14.6727 17.9914 14.2234 18.1261 13.7518H19.3067C20.1416 13.7518 20.8512 13.1416 20.9762 12.3161C21.0079 12.1066 21.0079 11.8935 20.9762 11.6839C20.8512 10.8584 20.1416 10.2483 19.3067 10.2483H18.126C17.9914 9.77662 17.8038 9.32734 17.5701 8.90726L18.4053 8.07205C18.9957 7.48168 19.0659 6.54849 18.5706 5.87637C18.4449 5.70578 18.2942 5.55509 18.1236 5.42937C17.4515 4.93407 16.5183 5.00434 15.9279 5.59471L15.0927 6.42992C14.6727 6.19617 14.2234 6.00857 13.7517 5.87396V4.69329Z" stroke="#FF885B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M18.1236 18.5706C17.4515 19.0659 16.5183 18.9957 15.9279 18.4053L15.0927 17.5701C14.6727 17.8038 14.2234 17.9914 13.7517 18.1261V19.3067C13.7517 20.1416 13.1416 20.8512 12.3161 20.9762C12.1066 21.0079 11.8934 21.0079 11.6839 20.9762C10.8584 20.8512 10.2482 20.1416 10.2482 19.3067V18.126C9.77662 17.9914 9.32734 17.8038 8.90726 17.5701L8.07205 18.4053C7.48169 18.9957 6.5485 19.0659 5.87638 18.5706C5.70578 18.4449 5.55509 18.2942 5.42937 18.1236C4.93407 17.4515 5.00434 16.5183 5.59471 15.9279L6.42992 15.0927C6.19617 14.6727 6.00857 14.2234 5.87396 13.7518H4.69329C3.85839 13.7518 3.14883 13.1416 3.0238 12.3161C2.99207 12.1066 2.99207 11.8935 3.0238 11.6839C3.14883 10.8584 3.85839 10.2483 4.6933 10.2483H5.87397C6.00857 9.77663 6.19617 9.32735 6.42992 8.90728L5.59471 8.07207C5.00434 7.4817 4.93407 6.54849 5.42937 5.87637C5.55509 5.70578 5.70578 5.55509 5.87637 5.42937C6.54849 4.93407 7.48168 5.00435 8.07205 5.59471L8.90726 6.42992C9.32734 6.19618 9.77662 6.00858 10.2482 5.87397V4.6933C10.2482 3.85839 10.8584 3.14883 11.6839 3.0238C11.8935 2.99207 12.1066 2.99207 12.3161 3.0238C13.1416 3.14883 13.7517 3.85839 13.7517 4.69329V5.87396C14.2234 6.00857 14.6727 6.19617 15.0927 6.42992L15.9279 5.59471C16.5183 5.00434 17.4515 4.93407 18.1236 5.42937" stroke="#0F5ABB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9.5 12C9.5 10.6193 10.6193 9.5 12 9.5C13.3807 9.5 14.5 10.6193 14.5 12C14.5 13.3807 13.3807 14.5 12 14.5C10.6193 14.5 9.5 13.3807 9.5 12Z" stroke="#FF885B" stroke-width="1.5"/>
                </svg>
            </a>
        </div>
    </div>
    <div id="appCapsule">
      @include('mobile.include.work-time-alert',['margin' => true])

        @livewire('mobile.account.upload-document',['primary_id' => session('customer_id')])

    </div>
    @include('inner.partials.bottom-menu')
@endsection

@push('scripts')
    <script src='https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.min.js'></script>
    <script src='https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js'></script>
    <script src='https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.min.js'></script>
    <script src='https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js'></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src='https://unpkg.com/filepond/dist/filepond.min.js'></script>
    <script>
        /*
        We want to preview images, so we need to register the Image Preview plugin
        */
        FilePond.registerPlugin(
            FilePondPluginFileEncode,
            FilePondPluginFileValidateSize,
            FilePondPluginImageExifOrientation,
            FilePondPluginImagePreview,
            FilePondPluginFileValidateType
        );
        // Select the file input and use create() to turn it into a pond
        const frontInput = document.querySelector('input[name="front"]');
        const backInput = document.querySelector('input[name="back"]');


        const front = FilePond.create(frontInput, {
            acceptedFileTypes: ['image/*', 'application/pdf'],
            labelIdle: `<div class=" d-flex    align-items-center ">

                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="40" height="40">
  <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
  <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
</svg>
                <div class="ms-1">
                    <p class="m-0 fw-semibold " style="opacity: 0.7;color: #4f4f4f">Upload Front Side of Document</p>
                </div>


            </div>`
        });
        const back = FilePond.create(backInput, {
            acceptedFileTypes: ['image/*', 'application/pdf'],
            labelIdle: `<div class=" d-flex    align-items-center ">

               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="40" height="40">
  <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
  <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
</svg>

                <div class="ms-1">
                    <p class="m-0 fw-semibold " style="opacity: 0.7;color: #4f4f4f">Upload Back Side of Document</p>
                </div>


            </div>`
        });
        //
        // const front = FilePond.create(frontInput, {
        //     acceptedFileTypes: ['image/*', 'application/pdf']
        // });
        // const back = FilePond.create(backInput, {
        //     acceptedFileTypes: ['image/*', 'application/pdf']
        // });

        FilePond.setOptions({
            server: {
                url: '{{ url('/') }}',
                timeout: 20000,
                process: {
                    url: '/upload/documents',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': "{{csrf_token()}}"
                    },
                    withCredentials: false,
                    onload: (response) => response.key,
                    onerror: (response) => response.data,
                    ondata: (formData) => {
                        return formData;
                    },

                },
                revert: (uniqueFileId, load) => {
                    // Reset the input value
                    //filePondElement.value = '';
                    // Call the load function to signal successful revert
                    load();
                }
            }
        });


        front.on('removefile', (error, file) => {
            window.livewire.emit('removeFront');
        });
        back.on('removefile', (error, file) => {
            window.livewire.emit('removeBack');
        });
        window.addEventListener('remove-files', event => {
            back.removeFiles();
            front.removeFiles();
        });

    </script>
@endpush


