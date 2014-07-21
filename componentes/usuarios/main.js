function suma(obj) {
    total=parseInt(document.getElementById("numero").value);
    if(obj.checked){ total+=parseInt(obj.alt); }
    else { total-=parseInt(obj.alt); }
    if(String(total)>=1){ $("#mensaje").css({"display":"block"}); }
    else { $("#mensaje").css({"display":"none"}); }
    if(String(total)==1){ $("#mensaje_editar").css({"display":"block"}); }
    else { $("#mensaje_editar").css({"display":"none"}); }
    document.getElementById("numero").value=String(total);
}