// Scripts
$(document).on('ready', function () {
    P.on('response', function (data) {
        var resp = JSON.stringify(data, null, 2);
        var arrParams = new Object();
        var link = window.location.href;
        arrParams.resp = resp;
        arrParams.requestID = data["requestId"];
        requestHttpAjax(link, arrParams, function (response) {
            if (data["status"]["status"] == "APPROVED"){
                var messagePB = new Object();
                // continuar con script
                showAlert("OK", "Success", messagePB); 
            }
        });
    });
});
function playOnPay(processUrl){
    P.init(processUrl);
}

  