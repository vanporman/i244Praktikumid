var beads = document.getElementsByClassName('bead');

window.onload = function(){
    
    for (var i = 0; i < beads.length; i++){
        beads[i].onclick = function(){
            changePlace(this);
        }
    }
    
    function changePlace(bead){
        if(window.getComputedStyle(bead).getPropertyValue('float') == 'left'){
            bead.style.cssFloat = 'right';
        }
        else{
            bead.style.cssFloat = 'left';
        }
    }
    
}