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
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-title">
                    <div>
                        <div class="row">
                            <div class="col-md-3">
                                <!-- <a href="#" id="add-items" class="btn btn-primary w-100 add">Add Item</a> -->
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
                    <form class="form" item="{{ $item->id }}" id="itemForm" action="" method="POST" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Update item</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id">

                                <div class="form-group">
                                    <label for="category">Items Category</label>
                                    <!-- <input type="text" name="category_id" class="form-control input-sm"> -->
                                    <select name="category_id" id="item_category" class="form-control" required>
                                        @foreach($categories as $category)
                                            @if($item->category_id == $category->id)
                                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                            @else
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Items Name</label>
                                    <input type="text"value="{{ $item->name }}" name="name" id="itemName" class="form-control input-sm">
                                </div>
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" value="{{ $item->slug }}" name="slug" id="itemSlug" class="form-control input-sm">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea type="text" id="description" name="description" class="form-control input-sm">{!! $item->description !!}</textarea>
                                </div>
                                <!-- <div class="form-group" id="files">
                                    <label for="images">Item Images</label>
                                    <input type="file" id="images" name="images[]" multiple accept=".png, .jpg, .jpeg, .gif, .jfif" class="form-control input-sm" />
                                </div> -->

                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary btn-update">Update</button>
                                <a href="{{ url('items/list') }}" class="btn btn-secondary" data-dismiss="modal">Close</a>
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
            $(document).ready(function() {
                tinymce.init({
                    selector: "textarea",
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

                // creating slug from item name
                $('#itemName').keyup(function() {
                    var text = $(this).val();
                    text = text.toLowerCase();
                    text = text.replace(/[^a-zA-Z0-9]+/g,'-');
                    $("#itemSlug").val(text);
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
                    var updateId = form.attr('item')
                    $.ajax({
                        type: "POST",
                        url: "/items/update/" + updateId,
                        data: formData,
                        success: function (data) {
                            if (data.success) {
                                    toastr.success(data.message);

                                } else {
                                    alert('error')
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
