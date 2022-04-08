const today = new Date();
today.setDate(today.getDate() - 1);
const yyyy = today.getFullYear();
let mm = today.getMonth() + 1; // Months start at 0!
let dd = today.getDate();

if (dd < 10) dd = '0' + dd;
if (mm < 10) mm = '0' + mm;

const todays = yyyy + '-' + mm + '-' + dd;

console.log(todays);

var url = 'https://newsapi.org/v2/everything?' +
          'q=astronomy&' +
          'excludeDomains=artnews.com'+
          'from='+todays+'&' +
          'sortBy=publishedAt&' +
          'language=en&'+
          'apiKey=ed7900a3032a445eb92095d76d4a62ad';
console.log(url)
var req = new Request(url);
var data = [];
fetch(url).then(response => 
    response.json().then(data => ({
        data: data,
        status: response.status
    })
).then(res => {
    console.log(res.data['articles']);
    data = res.data;

    for(i=0;i<20 ;i++){
        document.getElementById('tblog').innerHTML +=  "<article class='entry entrys time'>"+
        "<div class='entry-img' style='text-align:center' >"+
            "<img src='"+res.data['articles'][i]['urlToImage'] +"' alt='' class='img-fluid' width=80%></div>"+
        "<h2 class='entry-title'>"+
        " <a href='"+res.data['articles'][i]['url']+"'>"+ res.data['articles'][i]['title'] +"</a></h2>"+
        "<div class='entry-content'>"+
        "<p>"+res.data['articles'][i]['content']+"</p>"+
        "<div class='read-more'>"+
        "<a href='"+res.data['articles'][i]['url']+"'>Read More</a></div></div></article>";
    }
}));
