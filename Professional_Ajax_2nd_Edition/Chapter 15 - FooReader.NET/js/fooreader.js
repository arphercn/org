function getStyle(oElement, sProperty) {
    var sStyle;
    
    if (typeof window.getComputedStyle == "undefined") {
        sStyle = oElement.currentStyle[sProperty];
    } else {
        sStyle = getComputedStyle(oElement, "")[sProperty];
    }
    
    return parseInt(sStyle);
}

function getStyleNumber(oElement, sProperty) {   
    return parseInt( getStyle(oElement, sProperty) );
}

var fooReader = {
    parser  : null, //XParser feed object
    feeds   : [],   //Collection of OpmlFileFeed objects
    
    //HTML elements
    divFeedList     : null,
    divViewingItem  : null,
    divItemList     : null,
    divMessageTitle : null,
    aMessageLink    : null,
    divMessageBody  : null,
    divLoading      : null,
    
    selectedItem    : null, //Pointer to the currently selected item
    
    //A simple OPML reader
    readOpmlFile    : function (sXmlText) {
        var oXmlDom = zXmlDom.createDocument();
        oXmlDom.loadXML(sXmlText);
        
        var oRoot = oXmlDom.documentElement;
        
        var nlFeeds = zXPath.selectNodes(oRoot, "body/outline");
        
        for (var i = 0; i < nlFeeds.length; i++) {
            this.feeds.push( new this.OpmlFileFeed(nlFeeds[i]) );
        }
    },
    //Class to keep feeds organized
    OpmlFileFeed : function (oFeedNode) {
        this.title = oFeedNode.getAttribute("title");
        this.url = oFeedNode.getAttribute("xmlUrl");
    },
    //Add a feed to the feeds pane
    addFeed : function (sTitle, sUrl) {
		var aFeedLink = document.createElement("a");
		aFeedLink.appendChild(document.createTextNode(sTitle));
		aFeedLink.href = sUrl;
		aFeedLink.className = "feedlink";
		aFeedLink.title = "Load " + sTitle;
				
		aFeedLink.onclick = function () {
		    fooReader.loadFeed(this.href);
		    return false;
		};
		
		this.divFeedList.appendChild(aFeedLink);
    },
    
    //Sets the column header for the item pane.
    setViewingItem  : function (sViewingItem) {            
        this.divViewingItem.innerHTML = sViewingItem;
    },
    
    //Adds an item to the list.
    addItem : function (oItem, iNum) {
        var aItem = document.createElement("A");
        aItem.className = "itemlink";
        aItem.href = oItem.link.value;

        aItem.onclick = function () {
            var oSelectedItem = fooReader.selectedItem;

            if (oSelectedItem != this) {
                if (oSelectedItem) {
                    oSelectedItem.className = "itemlink";
                }

                fooReader.selectedItem = this;
                this.className = "itemlink-selected";
            }

            var iItemNum = this.getAttribute("frFeedItem");

            var oItem = fooReader.parser.items[iItemNum];
            fooReader.setMessage(oItem.title.value, oItem.link.value, oItem.description.value);
            return false;
        };
    	
        aItem.ondblclick = function () {
            window.open(this.href);
        };

        aItem.setAttribute("frFeedItem",iNum);
        aItem.id = "item" + iNum;

        var divHeadline = document.createElement("DIV");
        divHeadline.className = "itemheadline";
        divHeadline.innerHTML = oItem.title.value;

        var divDate = document.createElement("DIV");
        divDate.className = "itemdate";
        divDate.appendChild(document.createTextNode("Date: " + oItem.date.value));
        aItem.appendChild(divHeadline);
        aItem.appendChild(divDate);

        this.divItemList.appendChild(aItem);
    },
        
    //Clears all items.
    clearItems      : function () {
        while (this.divItemList.hasChildNodes()) {
            this.divItemList.removeChild(this.divItemList.lastChild);
        }
    },
    
    //Just an API method to easily select an item without clicking
    selectItem      : function (iItemNum) {
        var oItem = document.getElementById("item" + iItemNum);
        
        oItem.onclick.call(oItem); //hacky
    },
    
    //Set the message in the reading pane
    setMessage      : function (sTitle, sHref, sMessageBody) {
        this.divMessageTitle.innerHTML = sTitle;
        this.aMessageLink.href = sHref;
        this.divMessageBody.innerHTML = sMessageBody;
    },
    
    //Hides the loading <div/>
    hideLoadingDiv : function () {
        this.divLoading.style.display = "none";
    },
    
    //Shows the loading <div/>
    showLoadingDiv : function () {
        this.divLoading.style.display = "block";
    },
   
    //Loads the feed
    loadFeed    : function (sUrl) {
        this.showLoadingDiv();
        
        var sUrl = "xmlproxy.php?feed=" + encodeURIComponent(sUrl);
        
        xparser.getFeed(sUrl, this.loadFeed_callBack, this);
    },
    //Fired in this scope.
    loadFeed_callBack    : function (oFeed) {
        this.parser = oFeed;
        
        this.clearItems();
        
        this.setViewingItem(this.parser.title.value);
        
        for (var i = 0, item; item = this.parser.items[i]; i++) {
            this.addItem(item, i);        
        }
        
        this.hideLoadingDiv();
        
        this.selectItem(0);
    },
    
    //Called when the page first loads
    getFeedList   : function () {
        var oHttp = zXmlHttp.createRequest();
        
        //Get the OPML
        oHttp.onreadystatechange = function () {
            if (oHttp.readyState == 4) {
                if (oHttp.status == 200 || oHttp.status == 304) {
                    //Populate the fooReader.feeds collection
                    fooReader.readOpmlFile(oHttp.responseText);
                    
                    //Loop through each feed and add them to the section
                    for (var i = 0, feed; feed = fooReader.feeds[i]; i++) {
                        fooReader.addFeed(feed.title, feed.url);
                    }
                    //Load the first feed
                    fooReader.loadFeed(fooReader.feeds[0].url);
                }
            }
        };
        
        //Make the request unique to foil caching attempts.
        var date = (new Date()).getTime();
        oHttp.open("GET", "feeds.xml?time=" + date, true);
        oHttp.send(null);
    }
};

fooReader.init = function (evt) {
    var evt = (typeof evt == "undefined") ? window.event : evt; //get the right event object
        
    if (evt.type == "load") { //Things to initialize only on the load event
        fooReader.divFeedList        = document.getElementById("divFeedList");
        fooReader.divViewingItem     = document.getElementById("divViewingItem");
        fooReader.divItemList        = document.getElementById("divItemList");
        fooReader.divMessageTitle    = document.getElementById("divMessageTitle");
        fooReader.aMessageLink       = document.getElementById("aMessageLink");
        fooReader.divMessageBody     = document.getElementById("divMessageBody");
        fooReader.divLoading         = document.getElementById("divLoading");
        
        fooReader.getFeedList();
    }
        
    var divPaneContainer = document.getElementById("divPaneContainer");
    var divReadingPane = document.getElementById("divReadingPane");
    var divMessageContainer = document.getElementById("divMessageContainer");
    var divMessageHeader = document.getElementById("divMessageHeader");

    //Set the container's height.
    var iDocHeight = document.documentElement.clientHeight; //get the document's height.
    divPaneContainer.style.height = iDocHeight - divPaneContainer.offsetTop - 12 + "px";
    
    //Size divItemList
    var iItemListHeight = divPaneContainer.offsetHeight - fooReader.divViewingItem.offsetHeight -
        getStyleNumber(fooReader.divItemList, "paddingTop") - getStyleNumber(fooReader.divItemList, "paddingBottom");
    
    fooReader.divItemList.style.height = iItemListHeight  + "px";
    
    //Size divFeedsList
    var iFeedsListHeight = divPaneContainer.offsetHeight - fooReader.divViewingItem.offsetHeight - 
        getStyleNumber(fooReader.divFeedList, "paddingTop") - getStyleNumber(fooReader.divFeedList, "paddingBottom");
    
    fooReader.divFeedList.style.height = iFeedsListHeight +  "px";

    //Size divMessageBody. 
    var iMessageBodyHeight = divReadingPane.offsetHeight - divMessageHeader.offsetHeight -
       getStyleNumber(divMessageContainer, "paddingTop") - getStyleNumber(divMessageContainer, "paddingTop");
    
    fooReader.divMessageBody.style.height = iMessageBodyHeight + "px";
};

window.onload   = fooReader.init;
window.onresize = fooReader.init;