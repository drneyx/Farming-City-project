<div class="modal inmodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">image preview</h4>
                <small>Clicking change image without selecting the image, the default noimage.jpg will be saved instead</small>
            </div>
            <form role="form" id="form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="ibox w-100 parent">
                        <div class="ibox-title">
                            <h5>News image <small>preview</small></h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content thumb" style="height: 35vh;">
                                <img id="img" alt="No Image" onerror=this.src="{{url('images/noimage.jpg')}}" class="h-100 w-100" style="object-fit: cover;">
                        </div>
                    </div>
                        <div class="form-group">
                            <input type="file" name="image" onchange="previewImage(event)" class="form-control">
                        </div>
                        <div class="form-group prvw"  style="display: none;">
                            <div class="col-md-4">
                                <img class="w-100 thumbnail new_image" style="object-fit: cover; height: 15vh;" />
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">No,Cancel</button>
                    <button type="submit" class="btn btn-primary">Change Image</button>
                </div>
            </form>
        </div>
    </div>
</di>
<script>
    $('#'+ $('#selected_id').val()).on('show.bs.modal', function (event) {
        var myId = $('#selected_id').val();
        var button = $(event.relatedTarget) // Button that triggered the modal
        // var recipient = button.data('itm')
        // myId = $('#selected_id').val()
        console.log(myId)
        $('#preview' + myId).hide();
    });
    
    function previewImage(event){
        $('#preview' + $('#selected_id').val()).show();
        document.getElementById($('#selected_id').val()).style.display='block';
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('newimg'+$('#selected_id').val());
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    };
</script>