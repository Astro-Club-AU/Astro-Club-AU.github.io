

if (window.location.pathname == '/dashboard.html') {
    
    var url_auth = "../assets/data/blogsters.json";
    $.getJSON(url_auth, function (data) {
        $.each(data[2].data, function (key,value) {
            document.getElementById('authors').innerHTML += "<tr>"+
            "<td>"+value['auth-id']+"</td>"+
            "<td>"+value['auth-name']+"</td>"+
            "<td>"+value['Description']+"</td>"+
            "</tr>";
        }) 
    }); 

    var url_up = "../assets/data/upcoming_events.json";
    $.getJSON(url_up, function (data) {
        $.each(data[2].data, function (key,value) {
            document.getElementById('upcom').innerHTML += "<tr>"+
            "<td>"+value['id']+"</td>"+
            "<td>"+value['Name']+"</td>"+
            "<td>"+value['Description']+"</td>"+
            "<td>"+value['Image_name']+"</td>"+
            "</tr>";
        }) 
    }); 

    var url_comp = "../assets/data/completed_events.json";
    $.getJSON(url_comp, function (data) {
        $.each(data[2].data, function (key,value) {
            document.getElementById('comp').innerHTML += "<tr>"+
            "<td>"+value['id']+"</td>"+
            "<td>"+value['Name']+"</td>"+
            "<td>"+value['Description']+"</td>"+
            "<td>"+value['Image_name']+"</td>"+
            "</tr>";
        }) 
    }); 
 
    var url_team = "../assets/data/team.json";
    $.getJSON(url_team, function (data) {
        $.each(data[2].data, function (key,value) {
            document.getElementById('TM').innerHTML += "<tr>"+
            "<td>"+value['id']+"</td>"+
            "<td>"+value['Name']+"</td>"+
            "<td>"+value['Description']+"</td>"+
            "<td>"+value['Image_name']+"</td>"+
            "<td>"+value['Designation']+"</td>"+
            "</tr>";
        }) 
    });

    var url_alu = "../assets/data/alumni.json";
    $.getJSON(url_alu, function (data) {
        $.each(data[2].data, function (key,value) {
            document.getElementById('alu').innerHTML += "<tr>"+
            "<td>"+value['id']+"</td>"+
            "<td>"+value['Name']+"</td>"+
            "<td>"+value['description']+"</td>"+
            "<td>"+value['Image_name']+"</td>"+
            "<td>"+value['Designation']+"</td>"+
            "</tr>";
        }) 
    });

    var url_cat = "../assets/data/category.json";
    $.getJSON(url_cat, function (data) {
        $.each(data[2].data, function (key,value) {
            document.getElementById('categ').innerHTML += "<tr>"+
            "<td>"+value['cat-id']+"</td>"+
            "<td>"+value['cat-name']+"</td>"+
            "<td>"+value['cat-image']+"</td>"+
            "</tr>";
        }) 
    });
}


