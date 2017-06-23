function AjaxStockWatcher(oElement) {
    //Get the element we'll append to.
    //If one's not specified, use the document's <body/>
	this.toAppend = (oElement) ? oElement : document.body;
	
	//Create the table that'll house our data
	this.table = document.createElement("table");
	
	//Assign its CSS class
	this.table.className = "ajaxStockWatcher-table";
	
	//and append it to toAppend
	this.toAppend.appendChild(this.table);
	
	//For the timeout
	this.timer = null;
	
	//Begin polling.
	this.poll();
}

AjaxStockWatcher.prototype.poll = function() {
    //Pointer to the current object.
    var oThis = this;
    
    var oReq = zXmlHttp.createRequest();
        oReq.onreadystatechange = function () {
        if (oReq.readyState == 4) {
            if (oReq.status == 200 || oReq.status == 304) {
                oThis.handleResponse(oReq.responseText);
            }
        }
    };

    oReq.open("GET", "stockproxy.php", true);
    oReq.send(null);
};
			
AjaxStockWatcher.prototype.handleResponse = function (sJson) {   
    //Parse the JSON string
    var oResult = sJson.parseJSON();
    
    //Delete the existing stocks shown.   
    while (this.table.rows.length > 0)
        this.table.deleteRow(0);
           
    if (!oResult.error) {
        //No error. Display the information.
                
        for (var i = 0; i < oResult.stocks.length; i++) {
            var oStock = oResult.stocks[i];
            
            //Insert a new row
            var oRow = this.table.insertRow(i);
            
            //Add a cell for the stock's name
            var tdName = oRow.insertCell(0);
            tdName.className = "ajaxStockWatcher-stockName";
            
            //And the last trade amount.
            var tdLastTrade = oRow.insertCell(1);
            tdLastTrade.className = "ajaxStockWatcher-lastTrade";
            
            //And the change
            var tdChange = oRow.insertCell(2);
            tdChange.className = "ajaxStockWatcher-change";
            tdChange.className += (parseFloat(oStock.change) > 0) ? " ajaxStockWatcher-change-up" : " ajaxStockWatcher-change-down";
            
            var aLinkToYahoo = document.createElement("a");
            aLinkToYahoo.appendChild(document.createTextNode(oStock.companyName));
            aLinkToYahoo.href = "http://finance.yahoo.com/q?s=" + oStock.symbol;
            
            
            //Append the data to the <td/>s
            tdName.appendChild(aLinkToYahoo);
            tdLastTrade.appendChild(document.createTextNode(oStock.lastTrade));
            tdChange.appendChild(document.createTextNode(oStock.change));
        }
    } else { //An error occurred. Probably network related.
        //Insert a new row
        var oRow = this.table.insertRow(0);
        
        //Add a cell, and text to tell the user
        //an error occurred
        var tdError = oRow.insertCell(0)
        tdError.colSpan = 3;
        tdError.appendChild(document.createTextNode("An error occurred. Attempting to reconnect..."));
    }
    
    //Pointer to the current object.
    var oThis = this;
    
    //For the timeout
    var doSetTimeout = function () {
        oThis.poll();
    };
    
    //Do the timeout
    this.timer = setTimeout(doSetTimeout, 30000);
}

AjaxStockWatcher.prototype.stopPoll = function () {
    //Stop the polling
    clearTimeout(this.timer);
};