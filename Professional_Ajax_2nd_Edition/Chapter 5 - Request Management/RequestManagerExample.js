function outputResult(oResponse, sColor) {
   var divResponses = document.getElementById("divResponses");
   var oRequest = oResponse.request;
   var sMessage = "<div style=\"background-color:" + sColor + "\">"
            + oResponse.status + " (" + oRequest.priority + ") "
            + oRequest.type + " " + oRequest.url + " " + oRequest.age + "</div>";
   divResponses.innerHTML += sMessage;     
}

function outputSuccessResult(oResponse) {
    outputResult(oResponse, "white");
}

function outputFailureResult(oResponse) {
    outputResult(oResponse, "red");
}

function outputNotModifiedResult(oResponse) {
    outputResult(oResponse, "silver");
}


function addPoll() {
    RequestManager.poll({
        type : "get",
        url : "poll.txt",
        onsuccess : outputSuccessResult,
        onfailure : outputFailureResult,
        onnotmodified : outputNotModifiedResult
    });
}

function addSubmit() {
    RequestManager.submit({
        type : "post",
        url : "post.txt",
        data : "name=Nicholas",
        onsuccess : outputSuccessResult,
        onfailure : outputFailureResult,
        onnotmodified : outputNotModifiedResult
    });
}

function addSubmitPart() {
    RequestManager.submitPart({
        type : "post",
        url : "post.txt",
        data : "name=Nicholas",
        onsuccess : outputSuccessResult,
        onfailure : outputFailureResult,
        onnotmodified : outputNotModifiedResult
    });
}

function addPreFetch() {
    RequestManager.prefetch({
        type : "get",
        url : "data.txt",
        onsuccess : outputSuccessResult,
        onfailure : outputFailureResult,
        onnotmodified : outputNotModifiedResult
    });
}

function addLowPriority() {
    RequestManager.send({
        priority: 10,
        type : "get",
        url : "data.txt",
        onsuccess : outputSuccessResult,
        onerror : outputFailureResult,
        onnotmodified : outputNotModifiedResult
    });
}


window.onload = function () {

    addPoll();
    addPoll();
    addSubmit();
    addPreFetch();
    addLowPriority();
    addSubmitPart();
    addLowPriority();
    addPreFetch();
    addPoll();
    addSubmit();

}