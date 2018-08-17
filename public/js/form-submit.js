$.ajaxSetup(
{
    headers:
    { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
});
function submit_form(formAction,formdata,form,callback,async) 
{  
    $.ajax({
        url         : formAction,
        data        : formdata ? formdata : form.serialize(),
        cache       : false,
        contentType : false,
        processData : false,
        type        : 'POST',
        async       : async,
        beforeSend: function()
        {
            NProgress.start();
        },
        complete: function()
        {
            NProgress.done();
        },
        success: function(data, textStatus, jqXHR)
        {  
            NProgress.done();
            callback(data);
        },
        error: function (xhr, status, error,data) 
        {
            NProgress.done();
            errorHandle(xhr.status,xhr)
            callback(xhr.responseJSON);
        },
    });
}
function errorHandle(status,xhr)
{
    switch(parseInt(status)) 
    {
        case 200:
            toastr.success(xhr.responseText)
            return true;
            break;
        case 304: //Not Modified
            return false;
            break;
        case 400: //Bad Request
            toastr.warning(xhr.responseText)
            return false;
            break;
        case 401: 
            toastr.warning(xhr.responseText)
            return false;
            break;
        case 419: 
            //location.reload()
            toastr.info(xhr.responseText)
            return false;
            break;
        case 404: //Not Found
            toastr.error(xhr.responseText)
            return false;
            break; 
        case 406: //Not Acceptable
            location.reload()
            return false;
            break;
        case 500: //Not Acceptable
            toastr.error(xhr.responseText)
            return false;
            break;                       
        default:
    }
}
function ajax(url,data,type,callback)
{
    NProgress.start();
    $.ajax({
        url: url,
        type: type,
        data: data,
        success: function(data) 
        {
            NProgress.done();
            callback(data)
        },
        error: function (xhr, status, error,data) 
        {
            NProgress.done();
            errorHandle(xhr.responseJSON.status,xhr)
        }
    });
}