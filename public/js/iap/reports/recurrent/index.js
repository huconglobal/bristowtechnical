(window.webpackJsonp=window.webpackJsonp||[]).push([[49],{187:function(e,t,a){e.exports=a(188)},188:function(e,t,a){(function(e){e((function(){var t="".concat(locale.baseurl,"/iap/reports/recurrent/ajax/candidate"),a=sessionStorage.getItem("selectedCollection")||helix.firstCollectionId;a?e("#collection-select").val(a):a="";var o=e("#table-reports").DataTable({ajax:{url:"".concat(t,"/").concat(a)},autoWidth:!1,columns:[{data:"initials"},{data:"fullname"},{data:"subsessionCount"},{data:"briefed",type:"moment"},{data:"latest",type:"moment"},{data:"itemPercent"},{data:"result",type:"bool-icon"},{data:"button",orderable:!1}],order:[[2,"desc"],[1,"asc"]],processing:!0,stateSave:!0});e("#collection-select").selectize().change((function(){var a=e(this).val();sessionStorage.setItem("selectedCollection",a),o.ajax.url("".concat(t,"/").concat(a)),o.ajax.reload()}))}))}).call(this,a(1))}},[[187,0,1]]]);