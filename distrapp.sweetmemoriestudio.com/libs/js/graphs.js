google.load("visualization", "1", {packages: ["corechart"]});

function cargarChart(json, nombre) {

//   console.log(google)
    arr = [];
    for (el in json[0]) {
//        ele=
        arr.push([el, (json[0][el]) / 1]);
    }
    //////////////
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Topping');
    data.addColumn('number', 'Slices');
    data.addRows(arr);

    // Set chart options
    var options = {'title': nombre
    };
    console.log(options);
    // Instantiate and draw our chart, passing in some options.
//        alert("-.-.-");
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
}
function cargarChart2(json, nombre) {
//    alert("hola");
    if ($(".report").length == 0) {
        $("<a class='report' href='" + window.location.href + "/1'><img style='width:40px;height:40px' src='" + BASE + "/img/excel.png' ></a>").insertAfter("h1");
    }
    js = json;
    console.log(json)
    arr = [];
    for (el in json) {
//        console.log([json[el]["CNT"],json[el]["descripcion"]])
        arr.push([json[el]["descripcion"], (json[el]["CNT"]) / 1]);
//        ele=
//        arr.push([el,(json[0][el])/1]);
    }
    console.log(arr)
    //////////////
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Topping');
    data.addColumn('number', 'Slices');
    data.addRows(arr);

    // Set chart options
    var options = {'title': nombre
    };
    console.log(options);
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
