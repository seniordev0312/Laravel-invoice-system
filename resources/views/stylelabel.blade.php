@extends('labels-layout')

@section('title', 'Style')

@section('content')

<div id="CardContainer3">
    <div id="wb_Card3" style="display:flex;z-index:0;" class="card">
        <div id="Card3-card-body">
            <div id="Card3-card-item1">
                <div class="form-group">
                    <label for="style">Select:</label>
                    <select class="form-control" id="style" name="style" onchange="updateFields()">
                        <option value="">Select a style</option>
                        @foreach ($styles->sortBy('style') as $style)
                            <option value="{{ $style->style }}">{{ $style->style }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="Card3-card-item2">
                <div class="form-group-update">
                    <form action="{{ route('stylelabel.update') }}" method="POST" id="style-form">
                        @csrf
                        <div class="form-group">
                            <label for="update-style">Style:</label>
                            <input type="text" class="form-control" name="style" id="update-style" value="">
                            <label for="styleID">&nbsp;&nbsp;Style ID:</label>
                            <input type="text" class="form-control" name="styleID" id="styleID" disabled>
                        </div>
                        <div class="form-group">
                            <label for="description">French Description:</label>
                            <input type="text" class="form-control" id="description_fr" name="description_fr" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="description_en">English Description:</label>
                            <input type="text" class="form-control" id="description_en" name="description_en" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="number" class="form-control" id="price" name="price" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="photo_id">Photo ID:</label>
                            <input type="text" class="form-control" id="photo_id" name="photo_id" value="" required>
                        </div>
                        <div id="CardContainer5">
                            <button type="submit" class="btn-primary">Update Style</button>
                            <button type="button" class="btn-success" id="update-price-btn">Update Price</button>
                    </form>
                    <form id="delete-form" action="{{ route('stylelabel.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="style" id="delete-style" value="">
                        <button type="submit" class="btn-danger" onclick="return confirm('Are you sure you want to delete this style?')">Delete</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="CardContainer4">
    <div id="wb_Card4" style="display:flex;z-index:0;" class="card">
        <div id="Card4-card-body">
            <div id="Card4-card-item1">
                <span id="add-text">ADD Style</span>
                <div class="form-group-add">
                        <form action="{{ route('stylelabel.add') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="style">Style:</label>
                                <input type="text" class="form-control" id="style" name="style" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <input type="text" class="form-control" id="description_fr" name="description_fr" required>
                            </div>
                            <div class="form-group">
                                <label for="description_en">English Description:</label>
                                <input type="text" class="form-control" id="description_en" name="description_en" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="number" class="form-control" id="price" name="price" required>
                            </div>
                            <div class="form-group">
                                <label for="photo_id">Photo ID:</label>
                                <input type="text" class="form-control" id="photo_id" name="photo_id" required>
                            </div>
                            <button type="submit" class="btn-add">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

function updateFields() {
    var style = document.getElementById("style").value;
    var data = {"style": style, "_token": "{{ csrf_token() }}"};
    $.ajax({
        url: "{{ route('stylelabel.getstyle') }}",
        method: 'POST',
        data: data,
        dataType: 'json',
        success: function(styleData) {
            document.getElementById("update-style").value = styleData.style;
            document.getElementById("description_fr").value = styleData.description_fr;
            document.getElementById("description_en").value = styleData.description_en;
            document.getElementById("price").value = styleData.price;
            document.getElementById("photo_id").value = styleData.photoID;
            document.getElementById("styleID").value = styleData.styleID;

            // set value of delete form input field
            document.getElementById("delete-style").value = styleData.style;

        },
        error: function(xhr) {
            alert(xhr.responseText);
        }
    });
}


$(document).ready(function() {
        $('#update-price-btn').on('click', function() {
            var style = $('#update-style').val();
            var price = $('#price').val();
            var styleID = $('#styleID').val();

            $.ajax({
                url: "{{ route('stylelabel.updateprice') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    styleID: styleID,
                    style: style,
                    price: price
                },
                success: function(response) {
                    // Handle success response, e.g. display success message
                },
                error: function(xhr) {
                    // Handle error response, e.g. display error message
                }
            });
        });
});        

</script>
@endsection





