
var oXHR = null;
var iPageCount = 3;
var iCurPage = -1;
var iWaitBeforeLoad = 5000;
var iNextPageToLoad = -1;

function showPage(sPage) {

    var divPage = document.getElementById("divPage" + sPage);

    if (divPage) {
        for (var i=0; i < iPageCount; i++) {
            var iPageNum = i+1;
            var divOtherPage = document.getElementById("divPage" + iPageNum);
            var aOtherLink = document.getElementById("aPage" + iPageNum);
            if (divOtherPage && sPage != iPageNum) {
                divOtherPage.style.display = "none";
                aOtherLink.className = "";
            }
        }
        divPage.style.display = "block";
        document.getElementById("aPage" + sPage).className = "current";
    } else {
        location.href = getURLForPage(parseInt(sPage));
    }
}

function getURLForPage(iPage) {
    var sNewUrl = location.href;
    // 含有 ?page=1
    if (location.search.length > 0) {
        // 去掉含有 ?page=1, sNewUrl =http://localhost:8888/ArticleExample.php
        sNewUrl = sNewUrl.substring(0, sNewUrl.indexOf("?"));
    }
    sNewUrl += "?page=" + iPage;
    return sNewUrl;
}

function loadNextPage() {

    if (iNextPageToLoad <= iPageCount) {

        oXHR = zXmlHttp.createRequest();
        oXHR.open("get", getURLForPage(iNextPageToLoad) + "&dataonly=true", true);
        oXHR.onreadystatechange = function () {               
            
            if (oXHR.readyState == 4) {
                if (oXHR.status == 200) {
                    var divLoadArea = document.getElementById("divLoadArea");
                    divLoadArea.innerHTML = oXHR.responseText;                    
                    var divNewPage = document.getElementById("divPage" + iNextPageToLoad);
                    divNewPage.style.display = "none";
                    document.body.appendChild(divNewPage);  
                    divLoadArea.innerHTML = "";     
                    iNextPageToLoad++;
                    setTimeout(loadNextPage, iWaitBeforeLoad);             
                } 
                
                
            }
        };    
        oXHR.send(null);    
    }
}

//if Ajax is enabled, assign event handlers and begin fetching
window.onload = function () {
    if (zXmlHttp.isSupported()) {
        
        // 链接中含有page=
        if (location.href.indexOf("page=") > -1) {
            // 取出 page=1
            var sQueryString = location.search.substring(1);
            // 取出 1
            iCurPage = parseInt(sQueryString.substring(sQueryString.indexOf("=")+1));
        } else {
            iCurPage = 1;
        }
        
        iNextPageToLoad = iCurPage+1;

        var colLinks = document.getElementsByTagName("a");
        for (var i=0; i < colLinks.length; i++) {
            if (colLinks[i].id.indexOf("aPage") == 0) {
                colLinks[i].onclick = function (oEvent) {                    
                    var sPage = this.id.substring(5);

                    showPage(sPage);
                    
                    if (oEvent) {
                        oEvent.preventDefault(); 
                    } else {
                        window.event.returnValue = false;
                    }
                }
            }
        }
        
        setTimeout(loadNextPage, iWaitBeforeLoad);        
            
    }
};