function handleGetCustomerInfoResponse(sInfo) {
    displayCustomerInfo(sInfo);
}

function requestCustomerInfo() {
    var sId = document.getElementById("txtCustomerId").value;
    CustomerInfo.getCustomerInfo(parseInt(sId), handleGetCustomerInfoResponse);
}

function displayCustomerInfo(sText) {
    var divCustomerInfo = document.getElementById("divCustomerInfo");
    divCustomerInfo.innerHTML = sText;
}
