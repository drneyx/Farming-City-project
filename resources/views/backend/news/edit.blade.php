<x-app-layout>
    <style>
        .modal button {
            color: #000 !important;
        }
        .modal button:hover {
            color: #fff !important;
        }
        .tox-tinymce-aux {
               position: relative !important;
               z-index: 10055;
        }
        .image {
            width: 150px;
            height: 100px;
            object-fit: cover;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-title">
                    <div>
                        <div class="row">
                            <div class="col-md-3">
                                <!-- <a href="#" id="add-news" class="btn btn-primary w-100 add">Add News</a> -->
                            </div>
                        </div>
                    </div>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form class="form"news="{{ $news->id }}" id="newsForm" action="" method="POST" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Update News</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id">

                                <div class="form-group">
                                    <label for="name">Title</label>
                                    <input type="text" value="{{ $news->title }}" name="title" id="title" class="form-control input-sm">
                                    <input type="text" value="{{ $news->slug }}" name="slug" id="slug" class="form-control input-sm" style="display: none;">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea rows="2" type="text" name="description" class="form-control">{{ $news->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="body">Body</label>
                                    <textarea type="text" id="body" name="body" class="form-control body input-sm">{{ $news->body }}</textarea>
                                </div>
                                <!-- <div class="form-group" id="files">
                                    <label for="images">Image</label>
                                    <input type="file" id="image" name="images" onchange="preview_image(event)" accept=".png, .jpg, .jpeg, .gif, .jfif" class="form-control input-sm" />
                                </div>
                                <div class="form-group" id="previewimg" style="display: none;">
                                    <div class="col-md-3">
                                        <img id="output_image" class="w-100 thumbnail" style="object-fit: cover; height: 15vh;" />
                                    </div>
                                </div> -->

                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary btn-update">Update</button>
                                <a href="{{ url('news/list') }}" class="btn btn-secondary" data-dismiss="modal">Close</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    @section('items_scripts')

    <script src="{{ url('backend/js/jquery-3.1.1.min.js') }}"></script>
    <script>
        // preview image
        function preview_image(event){
            $('#previewimg').show();
            document.getElementById('output_image').style.display='block';
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('output_image');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        };
    </script>
        <script>
            $(document).ready(function() {
                tinymce.init({
                    selector: ".body",
                    // height: 300,
                    setup: function (editor) {
                        editor.on('change', function () {
                            editor.save();
                        });
                    },
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table contextmenu directionality emoticons template paste textcolor"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
                    menubar:false,
                });

              
                // creating slug from news title
                $('#title').keyup(function() {
                    var text = $(this).val();
                    text = text.toLowerCase();
                    text = text.replace(/[^a-zA-Z0-9]+/g,'-');
                    $("#slug").val(text);
                })

                $.noConflict();
                var token = $('meta[name="csrf-token"]').attr('content')
                var modal = $('.modal')
                var form = $('.form')
                var btnAdd = $('.add'),
                    btnSave = $('.btn-save'),
                    btnUpdate = $('.btn-update');


                btnUpdate.click(function(e){
                    e.preventDefault();
                    if(!confirm("Are you sure you want to perform this action?")) return;
                    var formData = form.serialize()+'&_method=PUT&_token='+token
                    var updateId = form.attr('news')
                    $.ajax({
                        type: "POST",
                        url: "/news/update/" + updateId,
                        data: formData,
                        success: function (data) {
                            if (data.success) {
                                    toastr.success(data.message);

                                } else {
                                    toastr.success('Error occured');
                                }
                        }
                    }); //end ajax
                })


                $(document).on('click','.btn-delete',function(){
                    if(!confirm("Are you sure you want to perform this action?")) return;

                    var rowid = $(this).data('rowid')
                    var el = $(this)
                    if(!rowid) return;


                    $.ajax({
                        type: "POST",
                        dataType: 'JSON',
                        url: "/news/delete/" + rowid,
                        data: {_method: 'delete',_token:token},
                        success: function (data) {
                            if (data.success) {
                                table.row(el.parents('tr'))
                                    .remove()
                                    .draw();

                                toastr.success(data.message);
                            }
                        }
                    }); //end ajax
                })


                $('#itemsName').keyup(function() {
                    var text = $(this).val();
                    text = text.toLowerCase();
                    text = text.replace(/[^a-zA-Z0-9]+/g,'-');
                    $("#itemsSlug").val(text);
                })

                $('#itemsForm').on('submit', function(e) {
                    e.preventDefault();
                    formData =
                        {
                            'name': $('#itemsName').val(),
                            'slug': $('#itemsSlug').val(),
                        };
                    // formData = $(this).serializeArray()
                    console.log(formData);
                    if($('#itemsName').val()) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        url = "{{ url('items/add') }}";
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: formData,
                            success: function (response) {
                                if (response.success) {
                                    table.ajax.reload();
                                    toastr.success(response.message);
                                    $(':input','#itemsForm').val('');

                                } else {
                                    alert('error')
                                }
                            },
                        });
                    }
                })
            })
        </script>
    @endsection
</x-app-layout>
