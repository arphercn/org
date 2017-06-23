//-----------------------------------------------------------------------------
// JavaScript code for JPSpan example
//-----------------------------------------------------------------------------

//define the handlers
var oHandlers = {

    getcustomerinfo : function (sInfo) {
        displayCustomerInfo(sInfo);
    }

};

//create the customerinfo object
var oInfo = new customerinfo(oHandlers);


function requestCustomerInfo() {
    var sId = document.getElementById("txtCustomerId").value;
    oInfo.getcustomerinfo(sId);
}

function displayCustomerInfo(sText) {
    var divCustomerInfo = document.getElementById("divCustomerInfo");
    divCustomerInfo.innerHTML = sText;
}