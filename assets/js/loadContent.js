// $( document ).ready(function() {
//     fetch('header-trans.txt')
//     .then(response => response.text())
//     .then(data => {
//         // document.getElementById('header').innerHTML = data;
//         $( data ).insertBefore( "#hero" );
//     });
// });
function custom_sort(a, b) {
    return a.id < b.id;
}

//Alumni
var url_al = "../assets/data/alumni.json";         
$.getJSON(url_al, function (data) {
    $.each(data[2].data, function (key,value) {
        document.getElementById('alumni').innerHTML += " <div class='row' data-aos='fade-up'><div class='col-md-5'><img src='assets/img/Alumni/" + value.Image_name +"' class='img-fluid' alt='Failed to Load' width=85% ></div>"+
        "<div class='col-md-7 pt-4'><h3>"+value.Name+"</h3>"+
        "<p class='font-italic'>"+value.Designation+"</p> <p>"+value.description+"</p></div></div>";
    }) 
});

//Upcoming events
var url_up = "../assets/data/upcoming_events.json";         
// id Name Description Image_name
var delay = 10;
$.getJSON(url_up, function (data) {
    $.each(data[2].data, function (key,value) {
        document.getElementById('upevents').innerHTML += "<div class='justify-content-center row'>"+
        "<div class='col-md-6 col-lg-3 d-flex align-items-stretch' data-aos='fade-up' data-aos-delay='"+delay+"'>"+
        "<div class='icon-box icon-box-cyan'>"+
            "<div><img src='assets/img/upcoming_events/"+value.Image_name+"' class='event-picture'></div>"+
            "<h4 class='title'><a href=''>'"+value.Name+"'</a></h4>"+
            "<p class='description'>'"+value.Description+"'</p>"+
        "</div></div>";
        delay+=10;
    }) 
});

//Completed Events
var url_ce = "../assets/data/completed_events.json";
// id Date Name Description Image_name
$.getJSON(url_ce, function (data) {
    data[2].data.sort(custom_sort);

    $.each(data[2].data, function (key,value) {
        document.getElementById('comevents').innerHTML += "<div class='col-md-6 d-flex align-items-stretch' data-aos='fade-up'>"+
       " <div class='card'>"+
          "<div class='card-img'>"+
            "<img src='assets/img/completed_events/"+value.Image_name+"' alt='...'>"+
          "</div>"+
          "<div class='card-body'>"+
            "<h5 class='card-title'><a href='#'>"+value.Name+"</a></h5>"+
            "<p class='card-text'>'"+value.Description.substring(0,90)+"..."+"'</p>"+
            "<div class='read-more'><a href='#Completed' data-toggle='modal' data-target='#Completed"+value.id+"'><i class='icofont-arrow-right'></i> Read More</a></div>"+
          "</div>"+
        "</div>"+
      "</div>" +
      "<div class='modal fade' id='Completed"+value.id+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLongTitle' aria-hidden='true'>"+
      "<div class='modal-dialog modal-lg modal-dialog-scrollable' >"+
        "<div class='modal-content'>"+
          "<div class='modal-header text-center'>"+
            "<h3 class='modal-title w-100'  id='exampleModalLongTitle'>"+value.Name+"</h3>"+
            "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>"+
              "<span aria-hidden='true'>&times;</span>"+
            "</button>"+
          "</div>"+
          "<div class='modal-body'>"+
            "<div class = 'row'>"+
              "<div class='col-md-12 justify-content-center' style='text-align:center'><img src='assets/img/completed_events/"+value.Image_name+"' alt='...' style='width:95%;padding-bottom:2%'></div>"+
              "<div class='col-md-11 mx-auto '><pre class='break'>"+value.Description+"</pre></div>"+
            "</div>"+
          "</div>"+
          "<div class='modal-footer'>"+
            "<button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>"+
          "</div></div></div></div>";
      
    })
});

//Team
var url_t = "../assets/data/team.json";         
// id Name Description Image_name Designation
$.getJSON(url_t, function (data) {
    $.each(data[2].data, function (key,value) {
        document.getElementById('team').innerHTML += "<div class='mx-auto col-lg-4 col-md-6 d-flex align-items-stretch'>"+
        "<div class='member'>"+
          "<div class='member-img'>"+
            "<img src='assets/img/team/"+value.Image_name+"' class='img-fluid' alt=''>"+
          "</div>"+
          "<div class='member-info'>"+
            "<h4>'"+value.Name+"'</h4>"+
            "<span>'"+value.Designation+"'</span>"+
            "<p>'"+value.Description+"'</p>"+
          "</div></div></div>";
       
    }) 
});

//Categories
var url_c = "../assets/data/category.json";         
// cat-id cat-name
$.getJSON(url_c, function (data) {
    $.each(data[2].data, function (key,value) {
        document.getElementById('entries-flters').innerHTML += "<li data-filter='.time"+value['cat-id']+"'>"+value['cat-name']+"</li>";
        // console.log(value); 
    }) 
});

var auth_arr={};
var url_auth = "../assets/data/blogsters.json";
$.getJSON(url_auth,function(data){
    $.each(data[2].data, function (key,value){
        auth_arr[value['auth-id']] = value['auth-name'];
    })
});

// console.log(auth_arr);

//Blog Posts
var url_bp = "../assets/data/blog.json";         
// cat-id auth-id blog-id content Image_name title date
$.getJSON(url_bp, function (data) {
    $.each(data[2].data, function (key,value) {
        var a_name ="";
        if (value['auth-id'] in auth_arr){
            a_name = auth_arr[value['auth-id']];
        }
        document.getElementById('tblog').innerHTML += "<article class='entry time"+value['cat-id']+"'>"+
        "<div class='entry-img' style='text-align:center'>"+
          "<img src='assets/img/blog-headers/"+value.Image_name+"' alt='' class='img-fluid' width=80%>"+
        "</div>"+
    
        "<h2 class='entry-title'>"+
          "<a href='blog-single.html?blog="+value['blog-id']+"'>"+value.title+"</a>"+
        "</h2>"+
        
        "<div class='entry-meta'>"+
      "<ul>"+ 
        "<li class='d-flex align-items-center'><i class='icofont-user'></i> <a href='blog-single.html?blog="+value['blog-id']+"'>"+a_name+"</a></li>"+
        "<li class='d-flex align-items-center'><i class='icofont-wall-clock'></i> <a href='blog-single.html?blog="+value['blog-id']+"'><time datetime='2020-01-01'>"+value.date+"</time></a></li>"+
      "</ul>"+
    "</div>"+
    "<div class='entry-content'>"+
      "<p>"+(value.content.substring(value.content.indexOf('</style>'),value.content.indexOf('</style>')+ 1008).replace(/(<([^>]+)>)/gi, "")).substring(0,500)+"..."+"</p>"+
      "<div class='read-more'>"+
        "<a href='blog-single.html?blog="+value['blog-id']+"'>Read More</a>"+
      "</div></div></article> <!-- End blog entry -->";
       
    }) 
});


//Single Blog Posts
var url_sbp = "../assets/data/blog.json";         
// cat-id auth-id blog-id content Image_name title date
$.getJSON(url_sbp, function (data) {
    $.each(data[2].data, function (key,value) {
        var a_name ="";
        if (value['auth-id'] in auth_arr){
            a_name = auth_arr[value['auth-id']];
        }
        const urlParams = new URLSearchParams(window.location.search);
        const code = urlParams.get('blog');
        
        if(value['blog-id'] == code)
            document.getElementById('sblog').innerHTML += "<article class='entry entry-single'>"+
                "<div class='entry-img' style='text-align: center;'>"+
                "<img src='assets/img/blog-headers/"+value.Image_name+"' alt='Failed' class='img-fluid'>"+
                "</div>"+
                "<h2 class='entry-title' style='text-align:center'>"+
                "<a href='blog-single.html?blog="+value['blog-id']+"'>"+value.title+"</a></h2>"+
                "<div class='entry-meta'>"+
                "<ul>"+
                "<li class='d-flex align-items-center'><i class='icofont-user'></i> <a href='blog-single.html?blog="+value['blog-id']+">"+a_name+"</a></li>"+
                "<li class='d-flex align-items-center'><i class='icofont-wall-clock'></i> <a href='blog-single.html?blog="+value['blog-id']+"><time datetime='2020-01-01'>"+value.date+"</time></a></li>"+
                "</ul></div>"+
                "<div class='entry-content col-md-12'>"+value.content+"</div></article><!-- End blog entry -->"+
                "<div class='blog-author clearfix'>"+
                "<img src='assets/img/blog-author_male.png' class=' float-left' alt=''>"+
                "<h4>"+a_name+"</h4>"+
                "<div class='social-links'>"+
                "<a href='https://twitters.com/#'><i class='icofont-twitter'></i></a>"+
                "<a href='https://facebook.com/#'><i class='icofont-facebook'></i></a>"+
                "<a href='https://instagram.com/#'><i class='icofont-instagram'></i></a></div>"+
                "<p>HEHEE</p></div><!-- End blog author bio -->";
    }) 
});

$("<footer id='footer' data-aos='fade-up' data-aos-easing='ease-in-out' data-aos-duration='900'>"+
"<div class='footer-newsletter'>"+
  "<div class='container'>"+
    "<div class='row'>"+
      "<div class='col-lg-6'>"+
        "<h4>Register here</h4>"+
        "<p  style='color:white'>Enter your mobile number to be added on Astro Club Whatsapp group. <b>(+91 Only)</b></p>"+
      "</div>"+
      "<div class='col-lg-6'>"+
        "<form action='register.html' method='post'>"+
          "<input name='number' type='tel' pattern='^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[789]\d{9}$' required><input type='submit' name='subs' value='Subscribe'>"+
        "</form></div></div></div></div>"+

"<div class='footer-top'>"+
  "<div class='container'>"+
    "<div class='row'>"+
      "<div class='col-lg-3 col-md-6 footer-links'>"+
        "<h4>Useful Links</h4>"+
        "<ul>"+
          "<li><i class='bx bx-chevron-right'></i> <a href='#'>Home</a></li>"+
          "<li><i class='bx bx-chevron-right'></i> <a href='about.html'>About us</a></li>"+
          "<li><i class='bx bx-chevron-right'></i> <a href='events.html'>Events</a></li>"+
          "<li><i class='bx bx-chevron-right'></i> <a href='blog.html'>Proxima Post</a></li>"+
          "<li><i class='bx bx-chevron-right'></i> <a href='contact.html'>Contact Us</a></li>"+
        "</ul></div>"+
      "<div class='col-lg-3 col-md-6 footer-contact'>"+
        "<h4>Contact Us</h4>"+
        "<p style='color:white'>"+
          "12, Sardar Patel Rd, <br>"+
          "Anna University, Guindy, <br>"+
          "Chennai, Tamil Nadu 600025 <br><br>"+
          "<strong>Phone:</strong> +91 98842 99162<br>"+
          "<strong>Email:</strong> astroclubau@gmail.com<br></p></div>"+
     " <div class='col-lg-3 col-md-6 footer-info'>"+
        "<h3>About Astro-Club</h3>"+
        "<p>Enthusiastic and curious Astrophiles always looking up to the stars and not the ground.</p>"+
        "<div class='social-links mt-3'>"+
          "<a href='https://www.facebook.com/astroclubofau' class='facebook'><i class='bx bxl-facebook' target='_blank'></i></a>"+
          "<a href='https://www.instagram.com/astroclub_au/' class='instagram' target='_blank' rel='noopener noreferrer'><i class='bx bxl-instagram'></i></a>"+
          "<a href='https://www.linkedin.com/in/astro-club-au-012019/' class='linkedin' target='_blank' rel='noopener noreferrer'><i class='bx bxl-linkedin'></i></a>"+
        "</div></div></div></div></div></footer>").insertBefore(".back-to-top");


