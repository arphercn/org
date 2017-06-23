function handleGetCustomerInfoResponse(oResponse) {
    if (!oResponse.error) {
        displayCustomerInfo(oResponse.value);
    } else {
        alert("An error occurred.");
    }
}

function requestCustomerInfo() {
    var sId = document.getElementById("txtCustomerId").value;
    Wrox.CustomerInfo.GetCustomerInfo(parseInt(sId), handleGetCustomerInfoResponse);
}

function displayCustomerInfo(sText) {
    var divCustomerInfo = document.getElementById("divCustomerInfo");
    divCustomerInfo.innerHTML = sText;
}
