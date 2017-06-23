
/**
 * [EventUtil]
 * @type {Object}
 */
var EventUtil = { 
  
    addHandler: function(element, type, handler){ 
        if (element.addEventListener){ 
            element.addEventListener(type, handler, false); 
        } else if (element.attachEvent){ 
            element.attachEvent("on" + type, handler); 
        } else { 
            element["on" + type] = handler; 
        } 
    }, 

    removeHandler: function(element, type, handler){ 
        if (element.removeEventListener){ 
            element.removeEventListener(type, handler, false); 
        } else if (element.detachEvent){ 
            element.detachEvent("on" + type, handler); 
        } else { 
            element["on" + type] = null; 
        } 
    },
 
    getEvent: function(event){ 
        return event ? event : window.event; 
    }, 
 
    getTarget: function(event){ 
        return event.target || event.srcElement; 
    },

    getRelatedTarget: function(event){ 
            if (event.relatedTarget){ 
                return event.relatedTarget; 
            } else if (event.toElement){ 
                return event.toElement; 
            } else if (event.fromElement){ 
                return event.fromElement; 
            } else { 
                return null; 
            } 
         
        }, 
    
    getButton: function(event){ 
            if (document.implementation.hasFeature("MouseEvents", "2.0")){ 
                return event.button;
        } else { 
            switch(event.button){ 
                case 0: 
                case 1: 
                case 3: 
                case 5: 
                case 7: 
                    return 0; 
                case 2: 
                case 6: 
                    return 2; 
                case 4:  
                    return 1; 
            } 
        } 
    },

    getWheelDelta: function(event){ 
        if (event.wheelDelta){ 
            return event.wheelDelta;  //不检测老版本opera
        } else { 
            return -event.detail * 40; 
        }
    }, 

    getCharCode: function(event){ 
        if (typeof event.charCode == "number"){ 
            return event.charCode; 
        } else { 
            return event.keyCode; 
        } 
    },

    getClipboardText: function(event){ 
        var clipboardData = (event.clipboardData || window.clipboardData); 
        return clipboardData.getData("text"); 
    },

    setClipboardText: function(event, value){ 
        if (event.clipboardData){ 
            return event.clipboardData.setData("text/plain", value);
        } else if (window.clipboardData){ 
            return window.clipboardData.setData("text", value); 
        } 
    },                        

    preventDefault: function(event){ 
        if (event.preventDefault){ 
            event.preventDefault(); 
        } else { 
            event.returnValue = false; 
        } 
    }, 
       
    stopPropagation: function(event){
        if (event.stopPropagation){ 
            event.stopPropagation(); 
        } else { 
            event.cancelBubble = true; 
        } 
    } 
 
};


/**
 * serialize form
 * 
 * example:14.4
 *     var form = document.getElementById('myForm');
 *     alert(serialize(form)); 
 * 
 * @param  {[object]} form [HTMLFormElement]
 * @return {[string]}      
 */
function serialize(form){         
    var parts = [], 
    field = null,     
    i,       
    len,    
    j,    
    optLen,   
    option,  
    optValue; 
     
    for (i=0, len=form.elements.length; i < len; i++){ 
        field = form.elements[i]; 
     
        switch(field.type){ 
            case "select-one": 
            case "select-multiple": 
 
            if (field.name.length){ 
                for (j=0, optLen = field.options.length; j < optLen; j++){
                        option = field.options[j]; 
                        if (option.selected){ 
                            optValue = ""; 
                            if (option.hasAttribute){ 
                                optValue = (option.hasAttribute("value") ?  
                                            option.value : option.text); 
                            } else { 
                                optValue = (option.attributes["value"].specified ?  
                                            option.value : option.text); 
                            } 
                            parts.push(encodeURIComponent(field.name) + "=" + 
                                       encodeURIComponent(optValue)); 
                        } 
                } 
            } 
            break; 
                 
            case undefined:       //字段集 
            case "file":          //文件输入 
            case "submit":        //提交按钮 
            case "reset":         //重置按钮 
            case "button":        //自定义按钮 
                break;                          
            case "radio":         //单选按钮 
            case "checkbox":       //复选框 
                if (!field.checked){ 
                    break; 
                }

                /* 执行默认操作 */                                     
            default: 
                //不包含没有名字的表单字段 
                if (field.name.length){ 
                    parts.push(encodeURIComponent(field.name) + "=" +  
                               encodeURIComponent(field.value)); 
                } 
        } 
    }         
    return parts.join("&"); 
}


/**
 * [createXHR] 22.1.3
 * @return {[object]}
 */
function createXHR(){  
    if (typeof XMLHttpRequest != "undefined"){ 
        createXHR = function(){
            return new XMLHttpRequest(); 
        }; 
        } else if (typeof ActiveXObject != "undefined"){ 
            createXHR = function(){ 
                if (typeof arguments.callee.activeXString != "string"){ 
                    var versions = ["MSXML2.XMLHttp.6.0", "MSXML2.XMLHttp.3.0", 
                                     "MSXML2.XMLHttp"], 
                        i, len; 
 
                    for (i=0,len=versions.length; i < len; i++){ 
                        try { 
                          new ActiveXObject(versions[i]); 
                          arguments.callee.activeXString = versions[i]; 
                             break; 
                        } catch (ex){ 
                            //skip 
                        } 
                    } 
                } 
 
                return new ActiveXObject(arguments.callee.activeXString); 
            }; 
        } else { 
            createXHR = function(){ 
                throw new Error("No XHR object available."); 
            }; 
        } 
 
    return createXHR(); 
}