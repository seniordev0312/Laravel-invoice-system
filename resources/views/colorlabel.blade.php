@extends('labels-layout')

@section('title', 'Color')

@section('content')

<div id="CardContainer6">
    <div id="wb_Card6" style="display:flex;z-index:0;" class="card">
        <div id="Card6-card-body">
            <div id="Card6-card-item1">
                <div class="form-group">
                    <label for="colorID">Select Color:</label>
                    <select class="form-control" id="colorID" name="colorID" onchange="updateFields()">
                        <option value="">Select a Color</option>
                        @foreach ($colors as $color)
                            <option value="{{ $color->colorID }}">{{ $color->colorID }} - {{ $color->color }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="Card6-card-item2">
                <div class="form-group-update">
                    <form action="{{ route('colorlabel.update') }}" method="POST" id="colorID-form">
                        @csrf
                        <div class="form-group">
                            <label for="update-colorID">Color ID:</label>
                            <input type="text" class="form-control" name="colorID" id="update-colorID" value="">
                        </div>
                        <div class="form-group">
                            <label for="color">Color:</label>
                            <input type="text" class="form-control" id="color" name="color" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="couleur">Couleur:</label>
                            <input type="text" class="form-control" id="couleur" name="couleur" value="" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
                    <div class="form-group-delete">
                        <form id="delete-form" action="{{ route('colorlabel.delete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="colorID" id="delete-colorID" value="">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this color ID?')">Delete</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="CardContainer7">
    <div id="wb_Card7" style="display:flex;z-index:0;" class="card">
        <div id="Card7-card-body">
            <div id="Card7-card-item1">
                <span id="add-text">ADD Color</span>
                    <div class="form-group-add">
                        <form action="{{ route('colorlabel.add') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="colorID">Color ID:</label>
                                <input type="text" class="form-control" id="colorID" name="colorID" required>
                            </div>
                            <div class="form-group">
                                <label for="color">Color:</label>
                                <input type="text" class="form-control" id="color" name="color" required>
                            </div>
                            <div class="form-group">
                                <label for="couleur">Couleur:</label>
                                <input type="text" class="form-control" id="couleur" name="couleur" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

function updateFields() {
    var colorID = document.getElementById("colorID").value;
    var data = {"colorID": colorID, "_token": "{{ csrf_token() }}"};
    $.ajax({
        url: "{{ route('colorlabel.getcolorID') }}",
        method: 'POST',
        data: data,
        dataType: 'json',
        success: function(colorData) {
            document.getElementById("update-colorID").value = colorData.colorID;
            document.getElementById("color").value = colorData.color;
            document.getElementById("couleur").value = colorData.couleur;

            // set value of delete form input field
            document.getElementById("delete-colorID").value = colorData.colorID;
        },
        error: function(xhr) {
            alert(xhr.responseText);
        }
    });
}
</script>

@endsection
