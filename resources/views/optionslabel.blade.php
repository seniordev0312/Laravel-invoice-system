@extends('labels-layout')

@section('title', 'Options')

@section('content')

<div id="CardContainer8">
    <div id="wb_Card8" style="display:flex;z-index:0;" class="card">
        <div id="Card8-card-body">
            <div id="Card8-card-item1">
                <div class="form-group">
                    <label for="optionID">Select Option:</label>
                    <select class="form-control" id="optionID" name="optionID" onchange="updateFields()">
                        <option value="">Select a option</option>
                        @foreach ($options as $option)
                        <option value="{{ $option->optionID }}">{{ $option->optionID }} - {{ $option->option }}</option>
                        @endforeach
                    </select>
                </div>
                </div>
            <div id="Card8-card-item2">
                <div class="form-group-update">
                    <form action="{{ route('optionslabel.update') }}" method="POST" id="optionID-form">
                        @csrf
                        <div class="form-group">
                            <label for="update-optionID">Option ID:</label>
                            <input type="text" class="form-control" name="optionID" id="update-optionID" value="">
                        </div>
                        <div class="form-group">
                            <label for="option">Option</label>
                            <input type="text" class="form-control" id="option" name="option" value="" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                <div class="form-group-delete">
                    <form id="delete-form" action="{{ route('optionslabel.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="optionID" id="delete-optionID" value="">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Option ID?')">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="CardContainer9">
    <div id="wb_Card9" style="display:flex;z-index:0;" class="card">
        <div id="Card9-card-body">
            <div id="Card9-card-item1">
                <span id="add-text">ADD Option</span>
                    <div class="form-group-add">
                        <form action="{{ route('optionslabel.add') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="optionID">Option ID:</label>
                            <input type="text" class="form-control" id="optionID" name="optionID" required>
                        </div>
                        <div class="form-group">
                            <label for="option">Option:</label>
                            <input type="text" class="form-control" id="option" name="option" required>
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
    var optionID = document.getElementById("optionID").value;
    var data = {"optionID": optionID, "_token": "{{ csrf_token() }}"};
    $.ajax({
        url: "{{ route('optionslabel.getoptionID') }}",
        method: 'POST',
        data: data,
        dataType: 'json',
        success: function(optionData) {
            document.getElementById("update-optionID").value = optionData.optionID;
            document.getElementById("option").value = optionData.option;

            // set value of delete form input field
            document.getElementById("delete-optionID").value = optionData.optionID;
        },
        error: function(xhr) {
            alert(xhr.responseText);
        }
    });
}
</script>

@endsection
