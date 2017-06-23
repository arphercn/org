
function PriorityQueue(fnCompare) {
    this._items = new Array();
    if (typeof fnCompare == "function"){
        this._compare = fnCompare;
    }
}

PriorityQueue.prototype = {

    _compare : function (oValue1, oValue2) {
        if (oValue1 < oValue2) {
            return -1;
        } else if (oValue1 > oValue2) {
            return 1;
        } else {
            return 0;
        }
    },

    get : function() {
        return this._items.shift();
    },
    
    item : function (iIndex) {
        return this._items[iIndex];
    },
    
    peek : function () {
        return this._items[0];
    },
    
    prioritize : function () {
        this._items.sort(this._compare);
    },

    put : function (oValue) {
        this._items.push(oValue);
        this.prioritize();
    }, 
    
    remove : function (oValue) {
        for (var i=0; i < this._items.length; i++) {
            if (this._items[i] === oValue) {
                this._items.splice(i, 1);
                return true;
            }
        }
        return false;
    },
    
    size : function () {
        return this._items.length;
    }

};


