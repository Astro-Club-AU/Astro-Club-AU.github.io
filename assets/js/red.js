var even = 0;
function red_mode(event){
    console.log(even);
    
    console.log(document.getElementsByTagName('html')[0].style.filter);
    if(even % 2 == 0){
        document.getElementsByTagName('html')[0].style.filter = 'grayscale(100%) brightness(40%) sepia(80%) hue-rotate(-50deg) saturate(500%) contrast(0.9)';
        localStorage.filter = "grayscale(100%) brightness(40%) sepia(80%) hue-rotate(-50deg) saturate(500%) contrast(0.9)";
      even++;
    }
    else{
        document.getElementsByTagName('html')[0].style.filter = '';
        localStorage.filter ='';
      even++;
    }

}