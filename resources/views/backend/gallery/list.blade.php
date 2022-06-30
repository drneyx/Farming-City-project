<x-app-layout>
    <style>
        .image-container {
            height: 200px;
            width: 250px;
        }
        .image-container img {
            height: 100%;
            padding: 5px;
            object-fit: cover;
        }
        #loader {
            position: fixed;
            left: 0px;
            top: 300px;
            width: 100%;
            height: 100%;
            z-index: 9999;
        }
    </style>
<div class="row">
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-title">
                    <div>
                        <div class="row">
                            <div class="col-md-3">
                                <h3>Filter Gallery</h3>
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
                    <form class="mt-2" id="itemFilterForm">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <select name="category_id" id="category" class="form-control">
                                    <option value="" selected>Select category</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <select name="item_id" id="item" class="form-control">
                                    <option value="" selected>Select Item</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button id="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">

                <div class="ibox-content">

                    <h2>Filtered Items</h2>
                    <div id='loader' style="display: no ne;"><center><img src="{{ url('backend/images/spinner.gif') }}"/></center></div>

                    <div class="lightBoxGallery row">


                        <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
                        <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-svgasimg blueimp-gallery-smil" style="display: none;">
                            <div class="slides" style="width: 92160px;" aria-live="polite"></div>
                            <h3 class="title">Item Image</h3>
                            <a class="prev">‹</a>
                            <a class="next">›</a>
                            <a class="close">×</a>
                            <a class="play-pause" aria-pressed="false"></a>
                            <ol class="indicator"></ol>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
</x-app-layout>

<script>
    $(document).ready(function() {

        $.ajax({
            type: 'GET',
            url: '/items/categories',
            success:function(data){
                console.log(data);
                $('#category').empty();
                $('#category').append("<option value='' + 'selected' +>"+'Select Category'+'</option>')
                $.each(data, function(index, categoryObj){
                    $('#category').append("<option value='"+categoryObj.id+"'>"+categoryObj.name+'</option>')
                })
            }
        });

        // get category items
        $('#category').on('change', function() {
            var categoryId = $(this).val()
            $.ajax({
                type: 'GET',
                url: '/categories/items/' + categoryId,
                success:function(data){
                    console.log(data);
                    $('#item').empty();
                    $('#item').append("<option value='' + 'selected' +>"+'Select Item'+'</option>')
                    $.each(data, function(index, itemObj){
                        $('#item').append("<option value='"+itemObj.id+"'>"+itemObj.name+'</option>')
                    })
                }
            });
        })

        // load gallery images
        $.ajax({
            dataType: "json",
            url: "/gallery/list",
        }).done(function(data) {
            if (data.length > 0) {
                data.forEach(function(value) {
                    console.log(data.length)
                    var image = value.image;
                    $('.lightBoxGallery').append('<a href="'+ image +  '" title="' + value.item.name +'" class="image-container" data-gallery=""><img src="' + image + '"></a>');
                })
            }
        });

        // apply filter
        $('#itemFilterForm').on('submit', function(e) {
            e.preventDefault();
            var itemId = $('#item').val();
            if(!itemId) {
                itemId = 0;
            }
            console.log(itemId)
            $('.lightBoxGallery').empty();

            $.ajax({
                dataType: "json",
                url: "/gallery/list/" + itemId,
            }).done(function(data) {
                if (data.length > 0) {
                    data.forEach(function(value) {
                        var image = value.image;
                        $('.lightBoxGallery').append('<a href="'+ image +  '" title="' + value.item.name +'" class="image-container" data-gallery=""><img src="' + image + '"></a>');
                    })
                }
            });
        })
    })
</script>
