
var oXHR = null;
var iInterval = 1000;
var iLastCommentId = -1;
var divNotification = null;
var blnRequestsEnabled = true;

function checkComments() {

    if (blnRequestsEnabled) {
        try {
            oXHR = zXmlHttp.createRequest();          
            oXHR.open("get", "CheckComments.php", true);
            oXHR.onreadystatechange = function () {               
                
                if (oXHR.readyState == 4) {
                    if (oXHR.status == 200) {
        
                        var aData = oXHR.responseText.split("||");
                        if (aData[0] != iLastCommentId) {                   
                            
                            iLastCommentId = aData[0];
                            
                            if (iLastCommentId != -1) {                        
                                showNotification(aData[1], aData[2]);
                            }
                            
                        }
                        
                        setTimeout(checkComments, iInterval);             
                    } else {
                        // 经测试,浏览器即使当CheckComments.php语法错误时,也返回200
                        // 暂未知原因
                        blnRequestsEnabled = false;
                        throw new Error("An error occurred while making the request.");
                    }                        
                } 
            };    
        
            oXHR.send(null); 
        } catch (oException) {
            blnRequestsEnabled = false;
        }
    } //End: if     
}

function showNotification(sName, sMessage) {
    if (!divNotification) {
        divNotification = document.createElement("div");
        divNotification.className = "notification";
        document.body.appendChild(divNotification);
    }
    
    divNotification.innerHTML = "<strong>New Comment</strong><br />" + sName 
              + " says: " + sMessage + "...<br /><a href=\"ViewComment.php?id=" 
              + iLastCommentId + "\">View</a>";
    divNotification.style.top = document.body.scrollTop + "px";
    divNotification.style.left = document.body.scrollLeft + "px";
    divNotification.style.display = "block";
    setTimeout(function () {
        divNotification.style.display = "none";
    }, 5000);
}

//if Ajax is enabled, assign event handlers and begin fetching
window.onload = function () {
    if (zXmlHttp.isSupported()) {
        checkComments();              
    }
};