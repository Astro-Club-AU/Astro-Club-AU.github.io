const form  = document.getElementById('authorr');
var buttonIndex;
form.addEventListener('submit', (event) => {
    // handle the form data
    if(buttonIndex==0){
        const id = document.getElementById('aid').value;
        const name = document.getElementById('aname').value;
        const desc = document.getElementById('adesc').value;

        url_auth = "../assets/data/blogsters.json";
        $.getJSON(url_auth,function(data){
            data[2].data.push(
                {"auth-id":id,"auth-name":name,"Description":desc}
            );
        });
        window.location.href ='dashboard.html';
    }
    if(buttonIndex == 1){

    }
    if(buttonIndex==-1){

    }  
});