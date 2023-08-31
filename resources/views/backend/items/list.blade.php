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
                                <a href="#" id="add-items" class="btn btn-primary w-100 add">Add Item</a>
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

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover items display wrap" id="items-table" style="width: 100%;" >
                            <thead>
                                <tr>
                                    <th width="3%">#</th>
                                    <th width="10%">Item Name</th>
                                    <th width="10%">Item Slug</th>
                                    <th width="10%">Item Description</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 0; ?>
                                    <?php $count++; ?>
                                    <tr>
                                        <td></td>
                                        <td style="text-transform: capitalize;"></td>
                                        <td style="text-transform: capitalize;"></td>
                                        <td>

                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                        <!-- Modal -->
                        <div class="modal" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg" role="document">
                                <form class="form" id="itemForm" action="" method="POST" enctype="multipart/form-data">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">New items</h5>
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
                                                    <option value="" selected>Select category</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Items Name</label>
                                                <input type="text" name="name" id="itemName" class="form-control input-sm">
                                            </div>
                                            <div class="form-group">
                                                <label for="slug">Slug</label>
                                                <input type="text" name="slug" id="itemSlug" class="form-control input-sm">
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea type="text" id="description" name="description" class="form-control input-sm"></textarea>
                                            </div>
                                            <div class="form-group" id="files">
                                                <label for="images">Item Images</label>
                                                <input type="file" id="images" name="images[]" multiple accept=".png, .jpg, .jpeg, .gif, .jfif" class="form-control input-sm" />
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary btn-save">Save</button>
                                            <button type="button" class="btn btn-primary btn-update">Update</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

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

                $.ajax({
                    type: 'GET',
                    url: '/items/categories',
                    success:function(data){
                        console.log(data);
                        $('#item_category').empty();
                        $('#item_category').append("<option value='' + 'selected' +>"+'Select Category'+'</option>')
                        $.each(data, function(index, categoryObj){
                            $('#item_category').append("<option value='"+categoryObj.id+"'>"+categoryObj.name+'</option>')
                        })
                    }
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

                var table = $('#items-table').DataTable({
                        ajax: '',
                        serverSide: true,
                        processing: true,
                        aaSorting:[[1,"desc"]],
                        columns: [
                            {data: 'id', name: 'id', visible: false},
                            {data: 'name', name: 'name'},
                            {data: 'slug', name: 'slug'},
                            {data: 'description', name: 'description', 
                                render: function(data) {
                                    return limit($('<span>'+data+'</span>').text(), 200);
                                }
                            },
                            {data: 'action', name: 'action'},
                        ]
                    });

                btnAdd.click(function(){
                    modal.modal()
                    form.trigger('reset')
                    modal.find('.modal-title').text('Add New Item')
                    btnSave.show();
                    btnUpdate.hide()
                })

                btnSave.click(function(e){
                    e.preventDefault();
                    var formData = form.serializeArray()
                    var data = new FormData(document.getElementById('itemForm'))

                    // data.append('inputs', form)
                      // Read selected file images
                    var totalimages = document.getElementById('images').files.length;
                    for (var index = 0; index < totalimages; index++) {
                        data.append("images[]", document.getElementById('images').files[index]);
                        console.log(document.getElementById('images').files[index]);
                    }
                    console.log(data)
                    // return;
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "/items/add",
                        data: data,
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            if (data.success) {
                                table.draw();
                                form.trigger("reset");
                                modal.modal('hide');
                                toastr.success(data.message);
                            }
                            else {
                                toastr.success("Error occured");
                            }
                        },
                        error: function (e) {
                            console.log(e)
                        }
                    }); //end ajax
                })


                // $(document).on('click','.btn-edit',function(){
                //     btnSave.hide();
                //     $('#files').hide();
                //     btnUpdate.show();


                //     modal.find('.modal-title').text('Update Item')
                //     modal.find('.modal-footer button[type="submit"]').text('Update')

                //     var rowData =  table.row($(this).parents('tr')).data()

                //     form.find('input[name="id"]').val(rowData.id)
                //     form.find('input[name="name"]').val(rowData.name)
                //     form.find('input[name="slug"]').val(rowData.slug)
                //     form.find('select[name="category_id"]').val(rowData.category_id)
                //     form.find('textarea[name="description"]').val(rowData.description)
                //     tinyMCE.activeEditor.setContent(rowData.description);
                //     console.log(tinyMCE.activeEditor.getContent())

                //     modal.modal()
                // })

                btnUpdate.click(function(){
                    if(!confirm("Are you sure you want to perform this action?")) return;
                    var formData = form.serialize()+'&_method=PUT&_token='+token
                    var updateId = form.find('input[name="id"]').val()
                    $.ajax({
                        type: "POST",
                        url: "/items/update/" + updateId,
                        data: formData,
                        success: function (data) {
                            if (data.success) {
                                    modal.modal('hide');
                                    table.ajax.reload();
                                    toastr.success(data.message);

                                } else {
                                    alert('error')
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
                        url: "/items/delete/" + rowid,
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
            });

            function limit (string = '', limit = 0) {  
                return string.substring(0, limit)
            }
        </script>
    @endsection
</x-app-layout>
