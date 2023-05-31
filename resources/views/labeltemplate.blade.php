<!DOCTYPE html>
<html>
<head>
    <link href="{{ asset('css/labeltemplate.css') }}" rel="stylesheet">
</head>
<body>
    <div id="wb_label-latexcare">
        <img src="images/latexcare.jpg" id="label-latexcare" alt="" width="214" height="288">
    </div>
    <div id="wb_Image2">
        <img src="images/logo.jpg" id="Image2" alt="">
    </div>
    <div id="wb_label-logo">
        <img src="images/logo.jpg" id="label-logo" alt="" width="178" height="64">
    </div>
    <div id="wb_Line1">
        <img src="images/img0001.png" id="Line1" alt="" width="198" height="0">
    </div>
    <div id="wb_Line2">
        <img src="images/img0002.png" id="Line2" alt="" width="198" height="0">
    </div>
    <div id="wb_Line3">
        <img src="images/img0003.png" id="Line3" alt="" width="198" height="0">
    </div>
    <div id="wb_Style">
    <span><strong>Style:</strong> <span id="template-selected-style"></span></span>
    </div>
    <div id="wb_Color">
    <span><strong>Color:<br>Couleur:</strong> <span id="template-selected-color"></span><span id="template-selected-couleur"></span></span>
    </div>
    <div id="wb_Size">
    <span><strong>Grandeur:<br>Size:</strong> <span id="template-selected-size"></span></span>
    </div>
    <div id="wb_Price">
        <span><strong>Price<br>Prix</strong></span>
    </div>
    <div id="wb_label-image"><img src="{{ asset('images/photo/' . $selectedPhotoID) }}" alt="Selected Photo"></div>
    </div>
    <div id="wb_label-style">{{ $style }}</div>
    <div id="wb_label-color">{{ $selectedColor }}</div>
    <div id="wb_label-couleur">{{ $selectedCouleur }}</div>
    <div id="wb_label-size">{{ $selectedSize }}</div>
    <div id="wb_label-barcode"><img src="{{ $barcodeValue }}" alt="Barcode"></div>
    <div id="wb_label-option">{{ $selectedOption }}</div>
    <div id="wb_label-extra">{{ $selectedExtra }}</div>
    <div id="wb_label-extra2">{{ $selectedExtra2 }}</div>
    <div id="wb_date">
        <span id="current-date"></span>
    </div>
    <script>
        var currentDate = new Date();
        var options = { day: '2-digit', month: '2-digit', year: 'numeric' };
        var dateString = currentDate.toLocaleDateString(undefined, options);
        document.getElementById("current-date").innerHTML = dateString;
    </script>
</body>
</html>
