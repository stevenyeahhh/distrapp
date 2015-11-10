google.load("visualization", "1", {packages:["corechart"]});

function cargarChart(json, nombre) {
    
//   console.log(google)
    arr=[];
    for(el in json[0]){
//        ele=
        arr.push([el,(json[0][el])/1]);
    }
    //////////////
    var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows(arr);

        // Set chart options
        var options = {'title':nombre,
                       };

        // Instantiate and draw our chart, passing in some options.
//        alert("-.-.-");
        var chart = new google.visualization.PieChart(document.getElementById('piechart')); 
        chart.draw(data, options);
}
function cargarChart2(json, nombre) {
    
   console.log(json)
    arr=[];
    for(el in json[0]){
//        ele=
        arr.push([el,(json[0][el])/1]);
    }
    //////////////
    var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows(arr);

        // Set chart options
        var options = {'title':nombre,
                       };

        // Instantiate and draw our chart, passing in some options.
//        alert("-.-.-");
        var chart = new google.visualization.PieChart(document.getElementById('piechart')); 
        chart.draw(data, options);
}


function drawChart(array, nombre) {
    var data = google.visualization.arrayToDataTable(array);

    var options = {
        title: nombre
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);
}