function dropSistema() {

  var valueSistema = document.getElementById("sistema").value

  if (valueSistema == "A") {
    //INPUT
    document.getElementById("empApollo").required = true
    document.getElementById("revApollo").required = true
    document.getElementById("empnbs").required = false
    document.getElementById("empnbs").value = ''

    //DIV
    document.getElementById("empresaNbs").style.display = "none"
    document.getElementById("empresaApollo").style.display = "block"
    document.getElementById("revendaApollo").style.display = "block"

  } else {
    //INPUT
    document.getElementById("empApollo").required = false
    document.getElementById("revApollo").required = false
    document.getElementById("empnbs").required = true
    document.getElementById("empApollo").value = ''
    document.getElementById("revApollo").value = ''

    //DIV
    document.getElementById("empresaNbs").style.display = "block"
    document.getElementById("empresaApollo").style.display = "none"
    document.getElementById("revendaApollo").style.display = "none"

  }
}

function onlynumber(evt) {
  var theEvent = evt || window.event;
  var key = theEvent.keyCode || theEvent.which;
  key = String.fromCharCode(key);
  //var regex = /^[0-9.,]+$/;
  var regex = /^[0-9.]+$/;
  if (!regex.test(key)) {
    theEvent.returnValue = false;
    if (theEvent.preventDefault) theEvent.preventDefault();
  }
}