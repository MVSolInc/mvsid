<html>
<head>
    <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

      <title>index</title>
      <meta name="description" content="" />
      <meta name="author" content="Christoph Oberhofer" />

      <meta name="viewport" content="width=device-width; initial-scale=1.0; user-scalable=no" />
      <link rel="stylesheet" type="text/css" href="{{asset('barcode/css/styles.css')}}" />

</head>
<body>
<section id="container" class="container">
  <h3>The user's camera</h3>
  <p>If your platform supports the <strong>getUserMedia</strong> API call, you can try the real-time locating and decoding features. Simply allow the page to access your web-cam and point it to a barcode. You can switch between <strong>Code128</strong> and
    <strong>EAN</strong> to test different scenarios. It works best if your camera has built-in auto-focus.
  </p>
  <div class="row">
      <div class="col-12">
          <div class="controls">
            <fieldset class="input-group">
                <button class="stop">Stop</button>
            </fieldset>
            <fieldset class="reader-config-group">
                <label>
                    <span>Barcode-Type</span>
                    <select class="form-control" name="decoder_readers">
                        <option value="ean" selected="selected">EAN</option>
                        <option value="code_128" >Code 128</option>
                        <option value="code_39">Code 39</option>
                        <option value="code_39_vin">Code 39 VIN</option>
                        <option value="ean_extended">EAN-extended</option>
                        <option value="ean_8">EAN-8</option>
                        <option value="upc">UPC</option>
                        <option value="upc_e">UPC-E</option>
                        <option value="codabar">Codabar</option>
                        <option value="i2of5">Interleaved 2 of 5</option>
                        <option value="2of5">Standard 2 of 5</option>
                        <option value="code_93">Code 93</option>
                    </select>
                </label>
                <label>
                    <span>Resolution (width)</span>
                    <select class="form-control" name="input-stream_constraints">
                        <option value="320x240">320px</option>
                        <option selected="selected" value="640x480">640px</option>
                        <option value="800x600">800px</option>
                        <option value="1280x720">1280px</option>
                        <option value="1600x960">1600px</option>
                        <option value="1920x1080">1920px</option>
                    </select>
                </label>
                <label>
                    <span>Patch-Size</span>
                    <select class="form-control" name="locator_patch-size">
                        <option value="x-small">x-small</option>
                        <option value="small">small</option>
                        <option selected="selected" value="medium">medium</option>
                        <option value="large">large</option>
                        <option value="x-large">x-large</option>
                    </select>
                </label>
                <label>
                    <span>Half-Sample</span>
                    <input type="checkbox" checked="checked" name="locator_half-sample" />
                </label>
                <label>
                    <span>Workers</span>
                    <select class="form-control" name="numOfWorkers">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option selected="selected" value="4">4</option>
                        <option value="8">8</option>
                    </select>
                </label>
                <label>
                    <span>Camera</span>
                    <select class="form-control" name="input-stream_constraints" id="deviceSelection">
                    </select>
                </label>
                <label style="display: none">
                    <span>Zoom</span>
                    <select class="form-control" name="settings_zoom"></select>
                </label>
                <label style="display: none">
                    <span>Torch</span>
                    <input type="checkbox" name="settings_torch" />
                </label>
            </fieldset>
        </div>
      </div>
  </div>
  <div id="result_strip">
    <ul class="thumbnails"></ul>
    <ul class="collector"></ul>
  </div>
  <div id="interactive" class="viewport"></div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
<script src="https://webrtc.github.io/adapter/adapter-latest.js" type="text/javascript"></script>
<script src="{{asset('barcode/quagga.js')}}" type="text/javascript"></script>
<script src="{{asset('barcode/live_w_locator.js')}}" type="text/javascript"></script>
</body>
</html>
