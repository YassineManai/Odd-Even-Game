var a = 1;
function hide1() {
    if (a == 1) {
        document.getElementsByClassName('hide')[0].style.visibility = 'visible';

    }
    else {
        document.getElementsByClassName('hide')[0].style.visibility = 'hidden';
        return a = 1

    }
   

   
   
   

}
/*function check(){
    var r = Math.floor(Math.random() * 100);
    document.getElementById("random").innerHTML = r;
    var c = (r % 2)
   
    if ( c  == 0){
        console.log('is even')
    }
    else{
        console.log('is odd')
    }
    
}*/