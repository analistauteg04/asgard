// Scripts
$(document).on('ready', function() {
    P.on('response', function(data) {
        //var resp = JSON.stringify(data, null, 2);
        var resp = data;
        var arrParams = new Object();
        var link = window.location.href;
        arrParams.resp = resp;
        arrParams.requestID = data["requestId"];
        arrParams.referenceID = data["reference"];
        $(".btnPago").hide();
        requestHttpAjax(link, arrParams, function(response) {
            //if (data["status"]["status"] == "APPROVED"){
            var wtmessage = data["status"]["message"];
            var label = (data["status"]["status"] == "APPROVED") ? objLang.Success : objLang.Error;
            var status = (data["status"]["status"] == "APPROVED") ? "OK" : "NO_OK";
            var callback = "returnFn";
            var lblAccept = (data["status"]["status"] == "APPROVED") ? objLang.Accept : objLang.Reload;
            resetSession(wtmessage, label, status, callback, lblAccept);
            //}
        }, true);
    });
});

function playOnPay(processUrl) {
    P.init(processUrl);
}

function returnFn() {
    parent.reloadPage();
    parent.closeIframePopup();
}