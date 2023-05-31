@extends('labels-layout')

@section('title', 'Label')

@section('content')

<div id="CardContainer1">
    <div id="wb_Card1" style="display:flex;z-index:0;" class="card">
        <div id="Card1-card-body">
            <div id="Card1-card-item1">
                <label for="style">Style:</label>
                <select name="style" id="style">
                    <option value="">Select a style</option>
                    @foreach($styles->sortBy('style') as $style)
                        <option value="{{ $style->styleID }}" data-photoID="{{ $style->photoID }}">{{ $style->style }}</option>
                    @endforeach
                </select><br>

                <label for="color">Color:</label>
                <select name="color" id="color">
                    @foreach($colors as $color)
                        <option value="{{ $color->colorID }}" data-couleur="{{ $color->couleur }}">{{ $color->color }}</option>
                    @endforeach
                </select><br>

                <label for="size">Size:</label>
                <select name="size" id="size">
                    <option value="">None</option> <!-- Default option -->
                    @foreach($sizes->sortBy('size') as $size)
                        <option value="{{ $size->sizeID }}">{{ $size->size }}</option>
                    @endforeach
                </select><br>

                <label for="option">Option:</label>
                <select name="option" id="option">
                    @foreach($Options as $option)
                        <option value="{{ $option->optionID }}">{{ $option->option }}</option>
                    @endforeach
                </select><br>

                <label for="extra">Extra:</label>
                <select name="extra" id="extra">
                    @foreach($Extras as $extra)
                        <option value="{{ $extra->extraID }}">{{ $extra->extra }}</option>
                    @endforeach
                </select><br>

                <div class="btn-container">
                    <div class="print-btn">
                        <button id="print-btn">Print</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="CardContainer2">
    <div id="wb_Card2" style="display:flex;z-index:1;" class="card">
        <div id="Card2-card-body">
            <div id="Card2-card-item1">
                <p>Style: <span id="selected-style"></span></p>
                <p class="hidden">StyleID: <span id="selected-styleID"></span></p>
                <p>Color: <span id="selected-color"></span></p>
                <p>Color FR: <span id="selected-couleur"></span></p>
                <p class="hidden">ColorID: <span id="selected-colorID"></span></p>
                <p>Size: <span id="selected-size"></span></p>
                <p class="hidden">SizeID: <span id="selected-sizeID"></span></p>
                <p>Option: <span id="selected-option"></span></p>
                <p class="hidden">OptionID: <span id="selected-optionID"></span></p>
                <p>Extra: <span id="selected-extra"></span></p>
                <p class="hidden">ExtraID: <span id="selected-extraID"></span></p>
                <p>Photo: <span id="selected-photoID"></span></p>
                <img id="selected-photo" src="{{ asset('images/photo/') }}" alt="Selected Photo">
                <p>Barcode:</p>
                <p class="barcode"><svg id="barcode"></svg></p>
            </div>
        </div>
    </div>
</div>


<script>
        function updateSelectedPhoto() {
            var selectedOption = document.getElementById("style").options[document.getElementById("style").selectedIndex];
            var selectedPhotoID = selectedOption.getAttribute("data-photoID");
            var selectedPhoto = document.getElementById("selected-photo");
            selectedPhoto.src = "{{ asset('images/photo') }}/" + selectedPhotoID;
            var selectedPhotoIDText = selectedOption.textContent;

            if (selectedOption && selectedPhotoID) {
                selectedPhoto.src = "{{ asset('images/photo') }}/" + selectedPhotoID;
                document.getElementById("selected-photoID").textContent = selectedPhotoIDText;
            } else {
                // Set the default picture
                selectedPhoto.src = "{{ asset('images/photo/nophoto.jpg') }}";
                document.getElementById("selected-photoID").textContent = "No photo available";
            }
        }

        updateSelectedPhoto(); // Call the function initially to set the correct image and text

        // Add an event listener to the style select element to update the image and text when a new option is selected
        document.getElementById("style").addEventListener("change", function() {
            updateSelectedPhoto();
        });

        var styleSelect = document.getElementById('style');
        var styleSelectID = document.getElementById('styleID');
        var photoIDSelect = document.getElementById('photoID');
        var colorSelect = document.getElementById('color');
        var couleurSelect = document.getElementById('couleur');
        var colorSelectID = document.getElementById('colorID');
        var sizeSelect = document.getElementById('size');
        var sizeSelectID = document.getElementById('sizeID');
        var optionSelect = document.getElementById('option');
        var optionSelectID = document.getElementById('optionID');
        var extraSelect = document.getElementById('extra');
        var extraSelectID = document.getElementById('extraID');

        var selectedStyle = document.getElementById('selected-style');
        var selectedStyleID = document.getElementById('selected-styleID');
        var selectedPhotoID = document.getElementById('selected-photoID');
        var selectedColor = document.getElementById('selected-color');
        var selectedCouleur = document.getElementById('selected-couleur');
        var selectedColorID = document.getElementById('selected-colorID');
        var selectedSize = document.getElementById('selected-size');
        var selectedSizeID = document.getElementById('selected-sizeID');
        var selectedOption = document.getElementById('selected-option');
        var selectedOptionID = document.getElementById('selected-optionID');
        var selectedExtra = document.getElementById('selected-extra');
        var selectedExtraID = document.getElementById('selected-extraID');

        var barcode = document.getElementById('barcode');

    styleSelect.addEventListener('change', function() {
        selectedStyle.textContent = this.options[this.selectedIndex].text;
        selectedPhotoID.textContent = this.options[this.selectedIndex].getAttribute('data-photoID');
        selectedStyleID.textContent = this.value;
        updateBarcode();

    // Update the value of selectedStyle for the print button
    selectedStyleValue = encodeURIComponent(this.options[this.selectedIndex].text);

    });

    colorSelect.addEventListener('change', function() {
        selectedColor.textContent = this.options[this.selectedIndex].text;
        selectedCouleur.textContent = this.options[this.selectedIndex].getAttribute('data-couleur');
        selectedColorID.textContent = this.value;
        updateBarcode();
    });

    sizeSelect.addEventListener('change', function() {
        selectedSize.textContent = this.options[this.selectedIndex].text;
        selectedSizeID.textContent = this.value;
        updateBarcode();
    });

    optionSelect.addEventListener('change', function() {
        selectedOption.textContent = this.options[this.selectedIndex].text;
        selectedOptionID.textContent = this.value;
        updateBarcode();
    });

    extraSelect.addEventListener('change', function() {
        selectedExtra.textContent = this.options[this.selectedIndex].text;
        selectedExtraID.textContent = this.value;
        updateBarcode();
    });

        var selectedStyleID = {textContent: '00000'};
        var selectedColorID = {textContent: '000'};
        var selectedSizeID = {textContent: '00'};
        var selectedOptionID = {textContent: '000'};
        var selectedExtraID = {textContent: '00'};
        var globalBarcodeDataUrl;
        var barcodeValue;

    function updateBarcode() {

        var styleID = selectedStyleID.textContent.padStart(5, '0');
        var colorID = selectedColorID.textContent.padStart(3, '0');
        var sizeID = selectedSizeID.textContent.padStart(2, '0');
        var optionID = selectedOptionID.textContent.padStart(3, '0');
        var extraID = selectedExtraID.textContent.padStart(2, '0');

        barcodeValue = styleID + colorID + sizeID + optionID + extraID;


        // Configure the barcode appearance
        var barcodeOptions = {
            format: "CODE128",
            width: 1, // Width of a single barcode line
            height: 30, // Height of the barcode
            displayValue: true, // Display the value below the barcode
            fontSize: 12, // Font size of the value below the barcode
            margin: 8, // Margin around the barcode (in pixels)
        };



        // Generate the barcode
        JsBarcode("#barcode", barcodeValue, barcodeOptions);

        // Convert the barcode to a Data URL
        var barcodeSvg = document.getElementById("barcode");
        globalBarcodeDataUrl = 'data:image/svg+xml;base64,' + btoa(barcodeSvg.outerHTML);

        console.log("globalBarcodeDataUrl:", globalBarcodeDataUrl);

    }


    function generatePrintableHtml() {
    // Retrieve the values of the selected label options
        var selectedStyle = document.getElementById('selected-style').textContent;
        var selectedColor = document.getElementById('selected-color').textContent;
        var selectedCouleur = document.getElementById('selected-couleur').textContent;
        var selectedSize = document.getElementById('selected-size').textContent;
        var selectedOption = document.getElementById('selected-option').textContent;
        var selectedExtra = document.getElementById('selected-extra').textContent;
        var selectedPhotoID = document.getElementById('selected-photoID').textContent;

        // Define the variables to be passed to the template
        var templateData = {
            selectedStyle: selectedStyle,
            selectedColor: selectedColor,
            selectedCouleur: selectedCouleur,
            selectedSize: selectedSize,
            selectedOption: selectedOption,
            selectedExtra: selectedExtra,
            selectedExtra2: selectedExtra2,
            selectedPhotoID: selectedPhotoID,
            barcodeValue: barcodeValue
        };

        // Compile the template with the variables
        var printableHtml = `
            <div id="wb_Style">
                <span><strong>Style:</strong> ${templateData.selectedStyle}</span>
            </div>
            <div id="wb_Color">
                <span><strong>Color:<br>Couleur:</strong> ${templateData.selectedColor} - ${templateData.selectedCouleur}</span>
            </div>
            <div id="wb_Size">
                <span><strong>Grandeur:<br>Size:</strong> ${templateData.selectedSize}</span>
            </div>
            <div id="wb_Price">
                <span><strong>Price<br>Prix</strong> ${templateData.selectedPrice}</span>
            </div>
            <div id="wb_label-image">
                <img src="${templateData.selectedPhotoID}" id="label-image" alt="">
            </div>
            <div id="wb_label-style">
                ${templateData.selectedStyle}
            </div>
            <div id="wb_label-color">
                ${templateData.selectedColor}
            </div>
            <div id="wb_label-couleur">
                ${templateData.selectedCouleur}
            </div>
            <div id="wb_label-size">
                ${templateData.selectedSize}
            </div>
            <div id="wb_label-barcode">
            <img src="${templateData.selectedImage}" id="label-image" alt="">
            </div>
            <div id="wb_label-option">
                ${templateData.selectedOption}
            </div>
            <div id="wb_label-extra">
                ${templateData.selectedExtra}
            </div>`;

            return printableHtml;
        }

    document.getElementById('print-btn').addEventListener('click', function() {
        // Get the selected values
            var style = encodeURIComponent(selectedStyle.textContent);
            var color = encodeURIComponent(selectedColor.textContent);
            var couleur = encodeURIComponent(selectedCouleur.textContent);
            var size = encodeURIComponent(selectedSize.textContent);
            var option = encodeURIComponent(selectedOption.textContent);
            var extra = encodeURIComponent(selectedExtra.textContent);
            var extra2;
            if(extra !== "") {
                extra2 = encodeURIComponent("Custom / Sur mesure");
            } else {
                extra2 = ""; }
            var photoID = encodeURIComponent(selectedPhotoID.textContent);



    // Make an AJAX request to the /print endpoint
    var xhr = new XMLHttpRequest();
        xhr.open('GET', '/print?style=' + style + '&color=' + color + '&couleur=' + couleur + '&size=' + size + '&option=' + option + '&extra=' + extra + '&extra2=' + extra2 + '&photoID=' + photoID + '&barcode=' + encodeURIComponent(globalBarcodeDataUrl));
        xhr.onload = function() {
        if (xhr.status === 200) {
            // On success, open a new window and write the printable HTML template to it
            var printWindow = window.open('', '_blank');
            printWindow.document.write(xhr.responseText);
            printWindow.document.close();
            printWindow.onload = function() {
            // After the window has loaded, trigger the print function
            printWindow.print();
            // Close the window after a short delay
            setTimeout(function() {
                printWindow.close();
                }, 700);
            };
        } else {
            // On error, log the error message to the console
            console.error('An error occurred while generating the printable label:', xhr.responseText);
            }
        };

    xhr.send();

});

</script>
@endsection
