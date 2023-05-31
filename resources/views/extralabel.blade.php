@extends('labels-layout')

@section('title', 'Extra')

@section('content')
<div id="CardContainer6">
    <div id="wb_Card6" style="display:flex;z-index:0;" class="card">
        <div id="Card6-card-body">
            <div id="Card6-card-item1">
                <div class="form-group">
                    <label for="extraID">Select Extra:</label>
                    <select class="form-control" id="extraID" name="extraID" onchange="updateFields()">
                        <option value="">Select a extra</option>
                        @foreach ($extras as $extra)
                        <option value="{{ $extra->extraID }}">{{ $extra->extraID }} - {{ $extra->extra }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="Card6-card-item2">
                <div class="form-group-update">
                    <div class="form-group-update">
                        <form action="{{ route('extralabel.update') }}" method="POST" id="extraID-form">
                            @csrf
                            <div class="form-group">
                                <label for="update-extraID">Extra ID:</label>
                                <input type="text" class="form-control" name="extraID" id="update-extraID" value="">
                            </div>
                            <div class="form-group">
                                <label for="extra">Extra</label>
                                <input type="text" class="form-control" id="extra" name="extra" value="" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                    <div class="form-group-delete">
                        <form id="delete-form" action="{{ route('extralabel.delete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="extraID" id="delete-extraID" value="">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Extra ID?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group-add">
<div id="CardContainer7">
    <div id="wb_Card7" style="display:flex;z-index:0;" class="card">
        <div id="Card7-card-body">
            <div id="Card7-card-item1">
                <span id="add-text">ADD Extra</span>
                    <form action="{{ route('extralabel.add') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="extraID">Extra ID:</label>
                            <input type="text" class="form-control" id="extraID" name="extraID" required>
                        </div>
                        <div class="form-group">
                            <label for="extra">Extra:</label>
                            <input type="text" class="form-control" id="extra" name="extra" required>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

function updateFields() {
    var extraID = document.getElementById("extraID").value;
    var data = {"extraID": extraID, "_token": "{{ csrf_token() }}"};
    $.ajax({
        url: "{{ route('extralabel.getextraID') }}",
        method: 'POST',
        data: data,
        dataType: 'json',
        success: function(extraData) {
            document.getElementById("update-extraID").value = extraData.extraID;
            document.getElementById("extra").value = extraData.extra;

            // set value of delete form input field
            document.getElementById("delete-extraID").value = extraData.extraID;
        },
        error: function(xhr) {
            alert(xhr.responseText);
        }
    });
}
</script>

@endsection
