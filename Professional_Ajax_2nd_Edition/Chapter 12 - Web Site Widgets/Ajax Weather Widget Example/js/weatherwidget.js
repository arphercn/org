function AjaxWeatherWidget(oElement) {
    this.element = (oElement)?oElement:document.body;
    this.lastModified = null;
	
    this.getWeather();	
}

AjaxWeatherWidget.prototype.getWeather = function () {
	var oThis = this;

    var oReq = zXmlHttp.createRequest();
    oReq.onreadystatechange = function () {
        if (oReq.readyState == 4) {
            if (oReq.status == 200 || oReq.status == 304) {
                oThis.element.innerHTML = oReq.responseText;
            }
        }
    };

    oReq.open("GET", "weather.php", true);
    oReq.send(null);
};