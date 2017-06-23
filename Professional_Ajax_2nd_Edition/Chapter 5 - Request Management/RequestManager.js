var RequestManager = function () {

    var oManager = {
    
        //---------------------------------------------------------------------
        // Constants
        //---------------------------------------------------------------------        
    
        /**
         * Maximum age for a priority before it must be promoted.
         * @type int
         */
        AGE_LIMIT : 60000,
        
        /**
         * Default priority to use if one is not provided.
         * @type int
         */
        DEFAULT_PRIORITY: 10,        
        
        /**
         * The number of milliseconds to check to the active requests.
         * @type int
         */
        INTERVAL : 250,
    
        //---------------------------------------------------------------------
        // Protected Properties
        //---------------------------------------------------------------------

        /**
         * Array of active requests.
         * @type Array
         */
        _active : new Array(),
        
        /**
         * Queue of pending requests.
         * @type PriorityQueue
         */
        _pending: new PriorityQueue(function (oRequest1, oRequest2) {
            return oRequest1.priority - oRequest2.priority;
        }),
        
        //---------------------------------------------------------------------
        // Protected Methods
        //---------------------------------------------------------------------
        
        /**
         * Places the given request into the pending queue to be sent.
         * @param {Request} oRequest The request decription object to send.
         */
        send : function (oRequest) {
            if(typeof oRequest.priority != "number"){
                oRequest.priority = this.DEFAULT_PRIORITY;
            }
            oRequest.active = false;
            oRequest.age = 0;
            this._pending.put(oRequest);
        },

        /**
         * Creates an appropriate XHR object depending on browser capabilities.
         * @type XMLHttpRequest
         */
        _createTransport : function (){
            if (typeof XMLHttpRequest != "undefined") {
                return new XMLHttpRequest();
            } else if (typeof ActiveXObject != "undefined") {
                var http = null;      
                try {
                    http = new ActiveXObject("MSXML2.XmlHttp.6.0");
                    return http;
                } catch (ex) {
                    try {
                        http = new ActiveXObjct("MSXML2.XmlHttp.3.0");
                        return http;
                    } catch (ex2) {
                        throw Error("Cannot create XMLHttp object.");
                    }
                }            
            }                
        },

        /**
         * Sends the next pending request.
         */
        _sendNext : function () {
            if (this._active.length < 2) {
                var oRequest = this._pending.get();
                if (oRequest != null) {
                    this._active.push(oRequest);
                    oRequest.transport = this._createTransport();
                    oRequest.transport.open(oRequest.type, oRequest.url, true);
                    oRequest.transport.send(oRequest.data);
                    oRequest.active = true;
                }
            }
            
        },
                
        /**
         * Checks active requests to see if any are complete.
         */
        _checkActiveRequests : function () {
        
            var oRequest = null;
            var oTransport = null;
            
            for (var i=this._active.length-1; i >= 0; i--) {
                oRequest = this._active[i];
                oTransport = oRequest.transport;
                if (oTransport.readyState == 4) {
                    oRequest.active = false;
                    this._active.splice(i, 1);        
                    var fnCallback = null;          
                    if (oTransport.status >= 200 && oTransport.status < 300) {
                        if (typeof oRequest.onsuccess == "function") {
                            fnCallback = oRequest.onsuccess;
                        }
                    } else if (oTransport.status == 304) {
                        if (typeof oRequest.onnotmodified == "function") {
                            fnCallback = oRequest.onnotmodified;
                        }
                    } else {
                        if (typeof oRequest.onfailure == "function") {
                            fnCallback = oRequest.onfailure;
                        }
                    }  
                    if (fnCallback != null) {
                        setTimeout((function (fnCallback, oRequest, oTransport) {
                            return function (){
                                fnCallback.call(oRequest.scope||window, { 
                                    status : oTransport.status, 
                                    data : oTransport.responseText, 
                                    request : oRequest});
                            }
                        })(fnCallback, oRequest, oTransport), 1);
                    }
        
                }
            }        
        
        },
                        
        //---------------------------------------------------------------------
        // Public Methods
        //---------------------------------------------------------------------
        
        /** 
         * Cancels the given request, removing it from the pending or active lists.
         * @param {Request} oRequest The request decription object to cancel.
         */
        cancel : function (oRequest) {
            if (!this._pending.remove(oRequest)){
            
                oRequest.transport.abort();
                
                if (this._active[0] === oRequest) {
                    this._active.shift();
                } else if (this._active[1] === oRequest) {
                    this._active.pop();
                }
                
                if (typeof oRequest.oncancel == "function") {
                    oRequest.oncancel.call(oRequest.scope||window, { 
                        request : oRequest});   
                }          
                
            }
        },
        
        /**
         * Searches through the pending requests for those that need to be
         * promoted and upgrades their priority.
         */
        _agePromote : function() {
            for (var i=0; i < this._pending.size(); i++) {
                var oRequest = this._pending.item(i);
                oRequest.age += this.INTERVAL;
                if (oRequest.age >= this.AGE_LIMIT){
                    oRequest.age = 0;
                    oRequest.priority--;
                }
            }
            this._pending.prioritize();        
        },
        
        /**
         * Places a high-priority request for a user action.
         * @param {Request} oRequest The request decription object to send.
         */
        submit : function (oRequest) {
            oRequest.priority = 0;
            this.send(oRequest);
        },

        /**
         * Places a submission throttling request.
         * @param {Request} oRequest The request decription object to send.
         */
        submitPart : function (oRequest) {
            oRequest.priority = 2;
            this.send(oRequest);
        },

        /**
         * Executes a request for Periodic Refresh.
         * @param {Request} oRequest The request decription object to send.
         */
        poll : function (oRequest) {
            oRequest.priority = 3;
            this.send(oRequest);
        },

        /**
         * Executes a request for Predictive Fetch or Multi-Stage Download.
         * @param {Request} oRequest The request decription object to send.
         */
        prefetch : function (oRequest) {
            oRequest.priority = 5;
            this.send(oRequest);
        }

    
    
    };    
    
    //setup interval to check everything
    setTimeout(function () {
        RequestManager._checkActiveRequests();
        RequestManager._sendNext();
        RequestManager._agePromote();
        setTimeout(arguments.callee, RequestManager.INTERVAL);
    }, oManager.INTERVAL);


    //return the object
    return oManager;

}();




