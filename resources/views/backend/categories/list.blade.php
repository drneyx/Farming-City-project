<x-app-layout>
    <style>
        .modal button {
            color: #000 !important;
        }
        .modal button:hover {
            color: #fff !important;
        }
    </style>
    <div class="row">
        <div class="col-md-8">
            <div class="ibox">
                <div class="ibox-title">
                    <!-- <div>
                        <div class="row">
                            <div class="col-md-3">
                                <a href="#" id="add-category" class="btn btn-primary w-100">Add category</a>
                            </div>
                        </div>
                    </div> -->
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
                        <table class="table table-striped table-bordered table-hover categories display wrap" id="category-table" style="width: 100%;" >
                            <thead>
                                <tr>
                                    <th width="3%">#</th>
                                    <th width="10%">Category Name</th>
                                    <th width="10%">Category Slug</th>
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
                            <div class="modal-dialog" role="document">
                                <form class="form" action="" method="POST">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">New Category</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="id">
                                            <div class="form-group">
                                                <label for="mainCategoryName">Select Main Category</label>
                                                <Select name="main_name" class="form-control mainCategoryName" id="mainCategoryName" required>

                                                </Select>
                                                <div class="text-danger" id="mainCatError"></div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Category Name</label>
                                                <input type="text" name="name" class="form-control input-sm">
                                            </div>
                                            <div class="form-group">
                                                <label for="slug">Slug</label>
                                                <input type="text" name="slug" class="form-control input-sm">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <!-- <button type="button" class="btn btn-primary btn-save">Save</button> -->
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

        <div class="ibox col-md-4" id="categoryForm" style="display: n one;">
            <div class="ibox-title">
                <div>
                    <div class="row">
                        <a href="#" id="add-category" class="btn btn-primary w-100">Add Items Category</a>
                    </div>
                </div>
                <div class="ibox-tools">
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="card">
                    <div class="card-body">
                        <form class="mt-2" id="categoryForm">
                            <div class="form-group">
                                <label for="mainCategoryName">Select Main Category</label>
                                <Select name="main_name" class="form-control mainCategoryName" id="mainCategoryName" required>

                                </Select>
                                <div class="text-danger" id="mainCatError"></div>
                            </div>
                            <div class="form-group">
                                <label for="categoryName">category Name</label>
                                <input type="text" name="name" class="form-control" id="categoryName" placeholder="eg. Bricks" required>
                                <div class="text-danger" id="catError"></div>
                            </div>
                            <div class="form-group" style="display: none;">
                                <label for="categoryName">category Slug</label>
                                <input type="text" name="slug" class="form-control" id="categorySlug" required>
                            </div>
                            <button id="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('category_scripts')

    <script src="{{ url('backend/js/jquery-3.1.1.min.js') }}"></script>
    <script>
        $.ajax({
            type: 'GET',
            url: '/main-categories',
            success:function(data){
                console.log(data);
                $('.mainCategoryName').empty();
                $('.mainCategoryName').append("<option value='' + 'selected' +>"+'Select Main Category'+'</option>')
                $.each(data, function(index, categoryObj){
                    $('.mainCategoryName').append("<option value='"+categoryObj.id+"'>"+categoryObj.name+'</option>')
                })
            }
        });
    </script>
        <script>
            $(document).ready(function() {
                $.noConflict();
                var token = $('meta[name="csrf-token"]').attr('content')
                var modal = $('.modal')
                var form = $('.form')
                var btnAdd = $('.add'),
                    btnSave = $('.btn-save'),
                    btnUpdate = $('.btn-update');

                var table = $('#category-table').DataTable({
                        ajax: '',
                        serverSide: true,
                        processing: true,
                        aaSorting:[[1,"desc"]],
                        columns: [
                            {data: 'id', name: 'id', visible: false},
                            {data: 'name', name: 'name'},
                            {data: 'slug', name: 'slug'},
                            {data: 'action', name: 'action'},
                        ]
                    });

                btnAdd.click(function(){
                    modal.modal()
                    form.trigger('reset')
                    modal.find('.modal-title').text('Add New')
                    btnSave.show();
                    btnUpdate.hide()
                })

                btnSave.click(function(e){
                    e.preventDefault();
                    var data = form.serialize()
                    console.log(data)
                    $.ajax({
                        type: "POST",
                        url: "",
                        data: data+'&_token='+token,
                        success: function (data) {
                            if (data.success) {
                                table.draw();
                                form.trigger("reset");
                                modal.modal('hide');
                                toastr.success(data.message);
                            }
                            else {
                                alert('Delete Fail');
                            }
                        }
                    }); //end ajax
                })


                $(document).on('click','.btn-edit',function(){
                    btnSave.hide();
                    btnUpdate.show();


                    modal.find('.modal-title').text('Update Category')
                    modal.find('.modal-footer button[type="submit"]').text('Update')

                    var rowData =  table.row($(this).parents('tr')).data()

                    form.find('input[name="id"]').val(rowData.id)
                    form.find('input[name="main_name"]').val(rowData.main_category_id)
                    form.find('input[name="name"]').val(rowData.name)
                    form.find('input[name="slug"]').val(rowData.slug)

                    modal.modal()
                })

                btnUpdate.click(function(){
                    if(!confirm("Are you sure?")) return;
                    var formData = form.serialize()+'&_method=PUT&_token='+token
                    var updateId = form.find('input[name="id"]').val()
                    $.ajax({
                        type: "POST",
                        url: "/categories/update/" + updateId,
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
                    if(!confirm("Are you sure?")) return;

                    var rowid = $(this).data('rowid')
                    var el = $(this)
                    if(!rowid) return;


                    $.ajax({
                        type: "POST",
                        dataType: 'JSON',
                        url: "/categories/delete/" + rowid,
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


                $('#categoryName').keyup(function() {
                    var text = $(this).val();
                    text = text.toLowerCase();
                    text = text.replace(/[^a-zA-Z0-9]+/g,'-');
                    $("#categorySlug").val(text);
                })

                $('#categoryForm').on('submit', function(e) {
                    e.preventDefault();
                    formData =
                        {
                            'name': $('#categoryName').val(),
                            'slug': $('#categorySlug').val(),
                        };
                    // formData = $(this).serializeArray()
                    console.log(formData);
                    if($('#categoryName').val()) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        url = "{{ url('categories/add') }}";
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: formData,
                            success: function (response) {
                                if (response.success) {
                                    table.ajax.reload();
                                    toastr.success(response.message);
                                    $(':input','#categoryForm').val('');

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
