function NewsTicker(oAppendTo) {
    var oThis = this;
    this.timer = null;
    this.feeds = [];
    this.tickerContainer = document.createElement("div");
    this.ticker = document.createElement("div");

    this.tickerContainer.className = "newsTickerContainer";
    this.ticker.className = "newsTicker";

    this.tickerContainer.onmouseover = function () {
        oThis.stopTick();
    };

    this.tickerContainer.onmouseout = function () {
        oThis.tick();
    };

    this.tickerContainer.appendChild(this.ticker);

    var oToAppend = (oAppendTo)?oAppendTo:document.body;
    oToAppend.appendChild(this.tickerContainer);

    this.ticker.style.left = this.tickerContainer.offsetWidth + "px";
    this.tick();
}

NewsTicker.prototype.tick = function () {
    var iTickerLength = this.ticker.offsetWidth;
    var oThis = this;

    var doSetTimeout = function() {
        oThis.tick();
    };

    if (this.ticker.innerHTML) {
        if (this.ticker.offsetLeft > -iTickerLength) {
            var iNewLeft = this.ticker.offsetLeft - 1;
            this.ticker.style.left = iNewLeft + "px";
        } else {
            this.ticker.style.left = this.tickerContainer.offsetWidth + "px";
        }
    }
    this.timer = setTimeout(doSetTimeout,1);
};
	    
NewsTicker.prototype.add = function (sUrl) {
    this.feeds.push(new NewsTickerFeed(this, sUrl));
};

NewsTicker.prototype.stopTick = function () {
    clearTimeout(this.timer);
    this.timer = null;
};

NewsTicker.prototype.dispose = function () {
    for (var i = 0, feedsLength = this.feeds.length; i < feedsLength; i++) {
        this.feeds[i].dispose();
    }

    this.stopTick();

    this.tickerContainer.parentNode.removeChild(this.tickerContainer);
    this.ticker = null;
    this.tickerContainer = null;
};

function NewsTickerFeed(oParent,sUrl) {
    this.timer      = null;
    this.parent     = oParent;
    this.url        = sUrl;
    this.container  = null;

    this.poll();
}
	    
NewsTickerFeed.prototype.poll = function () {
    var oThis = this;
    
    var sFullUrl = encodeURI("newsticker.php?url=" + this.url);
    
    xparser.getFeed(sFullUrl, NewsTickerFeed.prototype.populateTicker, this);
		    
    var doSetTimeout = function () {
        oThis.poll();
    };
    
    this.timer = setTimeout(doSetTimeout, 90000);
};

NewsTickerFeed.prototype.stopPolling = function () {
    clearTimeout(this.timer);
    this.timer = null;
};
	    
NewsTickerFeed.prototype.populateTicker = function (oParser) {
    var spanLinkContainer = document.createElement("span");

    var aFeedTitle = document.createElement("a");
    aFeedTitle.className = "newsTicker-feedTitle";
    aFeedTitle.href = oParser.link.value;
    aFeedTitle.target = "_new";
    aFeedTitle.innerHTML = oParser.title.value;

    spanLinkContainer.appendChild(aFeedTitle);

    for (var i = 0; i < oParser.items.length; i++) {
        var item = oParser.items[i];
    
        var aFeedLink = document.createElement("a");
        aFeedLink.href = item.link.value;
        aFeedLink.target = "_new";
        aFeedLink.className = "newsTicker-feedItem";
        aFeedLink.innerHTML = item.title.value;
    
        spanLinkContainer.appendChild(aFeedLink);
    }
	  	    
    if (!this.container) {
        this.container = document.createElement("span");
        this.container.className = "newsTicker-feedContainer";
        this.parent.ticker.appendChild(this.container);
    } else {
        this.container.removeChild(this.container.firstChild);
    }

    this.container.appendChild(spanLinkContainer);
};

NewsTickerFeed.prototype.dispose = function () {
    if (this.timer) this.stopPolling();
    if (this.container) {
        this.parent.ticker.removeChild(this.container);
        this.container = null;
    }

    this.parent = null;
};