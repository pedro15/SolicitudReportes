<script type = "text/javascript" src="chartist-js\chartist.min.js"></script>
<div class="ct-chart ct-perfect-fourth col-md-4 col-md-offset-4" style = "width:  35%; height: 35%;"></div>
<form>
  <input type=hidden name=Serie-A value="15">
  <input type=hidden name=Serie-B value="30">
  <input type=hidden name=Serie-C value="45">
  <input type=hidden name=Serie-A value="15">
  <input type=hidden name=Serie-B value="30">
  <input type=hidden name=Serie-C value="45">
</form>

<script type = "text/javascript">
var data = {
  labels: [ "Serie-A: " + document.querySelector('[name="Serie-A"]').value,
  "Serie-B: " + document.querySelector('[name="Serie-B"]').value,
  "Serie-C: " + document.querySelector('[name="Serie-C"]').value],

  series: [document.querySelector('[name="Serie-A"]').value,
  document.querySelector('[name="Serie-B"]').value,
  document.querySelector('[name="Serie-C"]').value]
};

var options = {
  labelInterpolationFnc: function(value) {
    return value[0]
  }
};

var responsiveOptions = [
  ['screen and (min-width: 640px)', {
    chartPadding: 20,
    labelOffset: 10,
    labelDirection: 'explode',
    labelInterpolationFnc: function(value) {
      return value;
    }
  }],
  ['screen and (min-width: 1024px)', {
    labelOffset: 20,
    chartPadding: 20
  }]
];

new Chartist.Pie('.ct-chart', data, options, responsiveOptions);
</script>