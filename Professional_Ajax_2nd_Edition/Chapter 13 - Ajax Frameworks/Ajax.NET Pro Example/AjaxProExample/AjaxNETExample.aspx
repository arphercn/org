<%@ Page Language="C#" AutoEventWireup="true" CodeFile="AjaxNETExample.aspx.cs" 
    Inherits="AjaxNETExample" %>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Ajax.NET Professional Example</title>
    <script type="text/javascript"src="AjaxNETExample.js"></script>
</head>
<body>
    <form id="Form1" runat="server"></form>
    <p>Enter customer ID number to retrieve information:</p>
    <p>Customer ID: <input type="text" id="txtCustomerId" value="" /></p>
    <p><input type="button" value="Get Customer Info" 
              onclick="requestCustomerInfo()" /></p>
    <div id="divCustomerInfo"></div>
</body>
</html>
