@extends('labels-layout')

@section('title', 'Size')

@section('content')

<div id="CardContainer6">
    <div id="wb_Card6" style="display:flex;z-index:0;" class="card">
        <div id="Card6-card-body">
            <div id="Card6-card-item1">
                <div class="form-group">
                    <label for="sizeID">Select Size:</label>
                    <select class="form-control" id="sizeID" name="sizeID" onchange="updateFields()">
                        <option value="">Select a size</option>
                        @foreach ($sizes as $size)
                        <option value="{{ $size->sizeID }}">{{ $size->sizeID }} - {{ $size->size }}</option>
                        @endforeach
                    </select>
                </div>
                </div>
            <div id="Card6-card-item2">
                <div class="form-group-update">
                    <form action="{{ route('sizelabel.update') }}" method="POST" id="sizeID-form">
                        @csrf
                        <div class="form-group">
                            <label for="update-sizeID">Size ID:</label>
                            <input type="text" class="form-control" name="sizeID" id="update-sizeID" value="">
                        </div>
                        <div class="form-group">
                            <label for="size">Size:</label>
                            <input type="text" class="form-control" id="size" name="size" value="" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
                <div class="form-group-delete">
                    <form id="delete-form" action="{{ route('sizelabel.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="sizeID" id="delete-sizeID" value="">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Size ID?')">Delete</button>
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
                <span id="add-text">ADD Size</span>
                    <div class="form-group-add">
                            <form action="{{ route('sizelabel.add') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="sizeID">Size ID:</label>
                                    <input type="text" class="form-control" id="sizeID" name="sizeID" required>
                                </div>
                                <div class="form-group">
                                    <label for="size">Size:</label>
                                    <input type="text" class="form-control" id="size" name="size" required>
                                </div>
                                <hr>
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
    var sizeID = document.getElementById("sizeID").value;
    var data = {"sizeID": sizeID, "_token": "{{ csrf_token() }}"};
    $.ajax({
        url: "{{ route('sizelabel.getsizeID') }}",
        method: 'POST',
        data: data,
        dataType: 'json',
        success: function(sizeData) {
            document.getElementById("update-sizeID").value = sizeData.sizeID;
            document.getElementById("size").value = sizeData.size;

            // set value of delete form input field
            document.getElementById("delete-sizeID").value = sizeData.sizeID;
        },
        error: function(xhr) {
            alert(xhr.responseText);
        }
    });
}
</script>

@endsection
