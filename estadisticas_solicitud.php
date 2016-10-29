<script type = "text/javascript" src="chartist-js\chartist.min.js"></script>
<div class = "text-center">
  <div class="ct-chart ct-perfect-fourth" style = "width:  35%; height: 35%;"></div>
</div>
<script type = "text/javascript">
var data = {
  series: [9, 3, 4]
};
var sum = function(a, b) { return a + b };
new Chartist.Pie('.ct-chart', data, {
  labelInterpolationFnc: function(value) {
    return Math.round(value / data.series.reduce(sum) * 100) + '%';
  }
});
</script>