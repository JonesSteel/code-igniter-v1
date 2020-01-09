<!-- CSS Section -->
<style>
    body, h1 {
        font-family: 'Source Sans Pro', sans-serif;
        font-size: 10%;
    }
</style>

<!-- JS Section -->
<script type="text/javascript">

    // Load the Visualization API and the corechart package
    google.charts.load('current', {'packages':['corechart']});

    // Set a callback to run when the Google Visualization API is loaded
    google.charts.setOnLoadCallback(drawChart);

    // Callback that creates and populates a data table
    // instantiates the pie chart, passes in the data and
    // draws it.
    function drawChart() {

        // Create the data table
        var jsonData = $.ajax({
            url: "<?php echo base_url('index.php/Admin_Controller/graficas_data');?>",
            dataType: "json",
            async: false
        }).responseText;

        // Create our data table out of JSON data loaded from server
        var data = new google.visualization.DataTable(jsonData);

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, {width: 1280, height: 720, title:'Porcentajes de Cajas por Tipo de Vehiculo'});
    }
</script>
<!-- Body Section -->
<h1 style="text-align: center">Gráficas</h1>
<br/>
<div id="chart_div" style="text-alignment: center">
</div>

