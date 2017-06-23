
function downloadLinks() {
    var oXHR = zXmlHttp.createRequest();
    
    oXHR.open("get", "AdditionalLinks.txt", true);
    oXHR.onreadystatechange = function () {
        if (oXHR.readyState == 4) {
            if (oXHR.status == 200) {
                setTimeout(function(){
                    var divAdditionalLinks = document.getElementById("divAdditionalLinks");
                    divAdditionalLinks.innerHTML = oXHR.responseText;  
                    divAdditionalLinks.style.display = "block";     
                }, 2000)
                         
            } 
        }    
    }
    oXHR.send(null);
}

window.onload = function () {
    if (zXmlHttp.isSupported()) {        
        downloadLinks();                  
    }
};